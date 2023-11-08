$(document).ready(function(){

	loadCart();
	loadWishlist();
	//like
	$('.like').on('click',function(e){
		var like_s =$(this).attr('data-like');
		var book_id = $(this).attr('book-id').slice(0,-2);
		//book_id = book-id.slice(0,-2);
		//alert(book_id);
	
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				'book_id':book_id,
				'like_s':like_s
			},
			url:'/downloadable_books/book-like',
			method:'POST',
			success:function(response){
				if(response.is_like == 1){
					$('*[book-id="'+ book_id +'_l"]').removeClass('btn-secondry').addClass('btn-success');
					$('*[book-id="'+ book_id +'_d"]').removeClass('btn-danger').addClass('btn-secondry');

					var count_like = $('*[book-id="'+ book_id +'_l"]').find('.like_count').text();
					var new_like = parseInt(count_like)+1;
					$('*[book-id="'+ book_id +'_l"]').find('.like_count').text(new_like);

					if(response.change_like == 1){
						var count_dislike = $('*[book-id="'+ book_id +'_d"]').find('.dislike_count').text();
						var new_dislike = parseInt(count_dislike)-1;
						$('*[book-id="'+ book_id +'_d"]').find('.dislike_count').text(new_dislike);
					}
				}
				if(response.is_like == 0){
					$('*[book-id="'+ book_id +'_l"]').removeClass('btn-success').addClass('btn-secondry');

					var count_like = $('*[book-id="'+ book_id +'_l"]').find('.like_count').text();
					var new_like = parseInt(count_like)-1;
					$('*[book-id="'+ book_id +'_l"]').find('.like_count').text(new_like);
				}
			}
			
		});
	});

	//dislike
	$('.dislike').on('click',function(e){
		var like_s =$(this).attr('data-like');
		var book_id = $(this).attr('book-id').slice(0,-2);
		
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				'book_id':book_id,
				'like_s':like_s
			},
			url:'/downloadable_books/book-dislike',
			method:'POST',
			success:function(response){
				if(response.is_dislike == 1){
					$('*[book-id="'+ book_id +'_d"]').removeClass('btn-secondry').addClass('btn-danger');
					$('*[book-id="'+ book_id +'_l"]').removeClass('btn-success').addClass('btn-secondry');

					var count_dislike = $('*[book-id="'+ book_id +'_d"]').find('.dislike_count').text();
					var new_dislike = parseInt(count_dislike)+1;
					$('*[book-id="'+ book_id +'_d"]').find('.dislike_count').text(new_dislike);

					if(response.change_dislike == 1){
						var count_like = $('*[book-id="'+ book_id +'_l"]').find('.like_count').text();
						var new_like = parseInt(count_like)-1;
						$('*[book-id="'+ book_id +'_l"]').find('.like_count').text(new_like);
					}

				}
				if(response.is_dislike == 0){
					$('*[book-id="'+ book_id +'_d"]').removeClass('btn-danger').addClass('btn-secondry');

					var count_dislike = $('*[book-id="'+ book_id +'_d"]').find('.dislike_count').text();
					var new_dislike = parseInt(count_dislike)-1;
					$('*[book-id="'+ book_id +'_d"]').find('.dislike_count').text(new_dislike);
				}
			}
			
		});
	});

	// Add To downloads
	$('.addToDownloads').click(function(e){
		e.preventDefault();
		var book_id = $(this).closest('.book_data').find('.book_id').val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				'book_id':book_id,
			},
			url:'/downloadable_books/add-to-download',
			method:'POST',
			success:function(resp){
				//Swal(resp.status);
					if(resp.type=="success"){
					$("#download-success").attr('style','color:#0f5132; background-color:#d1e7dd; padding:20px; border-color: #badbcc');
					$("#download-success").html(resp.message);
					$('.addToDownloads').css({'display':'none'})
					//setTimeout(function(){
						$("#download-success").css({'display':'none'});
						var timeleft = 10;
						var downloadTimer = setInterval(function(){
								if(timeleft <= 0){
									clearInterval(downloadTimer);
									//document.getElementById("countdown").innerHTML = "Finished";
									$('.new_link').css({'display':'block'})
								} else {
									document.getElementById("countdown").innerHTML = "Get the link in " +timeleft + "seconds";
									setTimeout(function() {
									$('#countdown').fadeOut('fast');
								}, 10000);
								}
								timeleft -= 1;
							}, 1000);
					//},3000);	
				}
				
			},error:function(){
				alert("Error");
			}
			
		});
	});

	//delete from cart
	$(document).on('click','.cart_delete',function(e){
		e.preventDefault();
		var book_id = $(this).closest('.book_data').find('.purchased_book_id').val();
		var trObj = $(this);
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				'book_id':book_id,
			},
			url:'delete-cart-item',
			method:'POST',
			success:function(response){
				if (response.status) {
					loadCart();
					//trObj.parents("tr").remove();
					$('.load').load(location.href +" .CartItems");
				}
			}
			
		});
	});

	//update cart
	$(document).on('click','.change_quantity',function(){
		//e.preventDefault();
		var book_id = $(this).closest('.book_data').find('.purchased_book_id').val();
		var book_qty = $(this).closest('.book_data').find('.cart_quantity_input').val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				'book_id':book_id,
				'book_qty':book_qty,
			},
			url:'update-cart-item',
			method:'POST',
			success:function(response){
				//alert(response);
				loadCart();
				window.location.reload();
				//$(".totalCartItems").html(response.totalCartItems);

			}
		
			
		});
	});

	function loadCart(){
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url:'/load-cart-count',
			method:'GET',
			success:function(response){
				$('.cart-count').html('');
				$('.cart-count').html(response.count);
			}
			
		});
	}

	function loadWishlist(){
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url:'/wishlists/load-wishlist-count',
			method:'GET',
			success:function(response){
				$('.wishlist-count').html('');
				$('.wishlist-count').html(response.count);
			}
			
		});
	}

	//delete from wishlist
	$(document).on('click','.wishlist_delete',function(e){
		e.preventDefault();
		var book_id = $(this).closest('.book_data').find('.purchased_book_id').val();
		//var trObj = $(this);
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				'book_id':book_id,
			},
			url:'delete-wishlist-item',
			method:'POST',
			success:function(response){
				if (response.status) {
					loadWishlist();
					//trObj.parents("tr").remove();
					$('.load').load(location.href +" .WishlistItems");
				}
			}
			
		});
	});

	//search
	var availableTagss = [];
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url:'/downloadable_books/downloadable-list',
		method:'GET',
		success:function(response){
			startAutocompletee(response);
		},error:function(){
			alert("Error");
		}
	
	});

	function startAutocompletee(availableTagss){
		$( "#search_downloadable" ).autocomplete({
			source: availableTagss
		});
	}  

	//search
	var availableTags = [];
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url:'/purchasable_books/purchased-list',
		method:'GET',
		success:function(response){
			startAutocomplete(response);
		},error:function(){
			alert("Error");
		}
	
	});

	function startAutocomplete(availableTags){
		$( "#search_purchased" ).autocomplete({
			source: availableTags
		});
	}  

	//purchased book sort
	$('#purchased_sort').on('change',function(){
		var sort_by = $('#purchased_sort').val();
		//var sort_by = $(this).closest('.mmm').find('#sort').val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				'sort_by':sort_by,
			},
			url:'/purchasable_books/sort-by',
			method:'GET',
			success:function(resp){
				//alert(resp.books);
				$('.search_result').html(resp);
				$('.search_result').html(jQuery(resp).find('.content').html());
			},error:function(){
				alert("Error");
			}
			
		});
	});

	//downloaded book sort
	$('#downloaded_sort').on('change',function(){
		var sort_by = $('#downloaded_sort').val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				'sort_by':sort_by,
			},
			url:'/downloadable_books/sort-by',
			method:'GET',
			success:function(resp){
				//alert(resp.books);
				$('.search_result').html(resp);
				$('.search_result').html(jQuery(resp).find('.content').html());
			},error:function(){
				alert("Error");
			}
			
		});
	});
	

});