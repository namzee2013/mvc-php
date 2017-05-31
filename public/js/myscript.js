$(document).ready(function() {
  var page = 0;
  var limit = 5;
  var total;
  var isLoading = true;
  var data = {
    page: page,
    limit: limit
  }

  if (isLoading && document.getElementById('blogs') != null) {
    document.getElementById('isloading').innerHTML = '<img src="/public/img/loader.gif" alt="">';
    $.ajax({
      type: "get",
      dataType: "JSON",
      url: "/blog/getblogs",
      data: data,
      success: function(result)
      {

        if (result.error > 0 || result.total === 0) {
          document.getElementById('innerHTML').innerHTML = '<li class="text-center">404 NOT FOUND</li>';
          document.getElementById('loadmore').innerHTML = 'Load More (0/0)';
          $('#loadmore').addClass('disabled')
        }else {
          page = result.page;
          limit = result.limit;
          var total = result.total;
          document.getElementById('innerHTML').innerHTML = result.data;
          isLoading = false;
          if (!isLoading) {
            if (Number(total) <= Number(limit)) {
              document.getElementById('loadmore').innerHTML =  'Load More (0/' + total + ')'
            }else {
              document.getElementById('loadmore').innerHTML =  'Load More (' + (total-((page+1)*limit)) + '/' + total + ')'
            }

          }
          if ((page+1)*limit >= total) {
            $('#loadmore').addClass('disabled')
          }
        }
        document.getElementById('isloading').innerHTML = '';

      }
    })
  }

  $('#loadmore').click(function(){
    //alert('loadmore')
    isLoading = true;
    document.getElementById('isloading').innerHTML = '<img src="/public/img/loader.gif" alt="">';
    var data = {
      page: Number(page) + 1,
      limit: limit
    }
    $.ajax({
      type: "get",
      dataType: "JSON",
      url: "/blog/loadmore",
      data: data,
      success: function(result)
      {
        if (result.error > 0) {
          document.getElementById('innerHTML').innerHTML += '<li class="text-center">Error Load, please enter F5</li>';
        }else{
          page = result.page;
          limit = result.limit;
          total = result.total;
          document.getElementById('innerHTML').innerHTML += result.data;
          isLoading = false;
          if (!isLoading && (Number(total)-(Number(page)+1)*Number(limit)) > 0) {
            document.getElementById('loadmore').innerHTML = 'Load More (' + (Number(total)-(Number(page)+1)*Number(limit)) + '/' + total + ')';
          }else {
            document.getElementById('loadmore').innerHTML = 'Load More (0/' + total + ')';
          }
          if ((Number(page)+1)*Number(limit) >= total) {
            $('#loadmore').addClass('disabled')
          }
        }
        document.getElementById('isloading').innerHTML = '';
      }
    })
  })

  $('#saveblog').click(function(){

    var data = {
        content: $('#content').val()
    };
    $.ajax({
      type : "post",
      dataType : "JSON",
      url : "/blog/save",
      data : data,
      success : function(result)
      {
        if (result.error > 0) {
          document.getElementById('blogErr').innerHTML = result.data;
          document.getElementById('blogSuccess').innerHTML = ''
        }else {
          var oldHTML = document.getElementById('innerHTML').innerHTML;
          document.getElementById('innerHTML').innerHTML = result.data + oldHTML;
          document.getElementById('blogErr').innerHTML = '';
          document.getElementById('blogSuccess').innerHTML = 'Success'
        }

      }
    })
  })
})
