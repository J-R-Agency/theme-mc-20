( function( $ ) {
					
		function changePage(listElement, pager) {
			//var listElement = $('.all');
			//var pager = '.pager-all';
			var perPage = 2; 
			var numItems = listElement.children().size();
			var numPages = Math.ceil(numItems/perPage);
							
			$(pager).data("curr",0);
			
			var curr = 0;
			while(numPages > curr){
			  $('<li><a href="#case-studies-container" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
			  curr++;
			}
			
			$("<span class='prev-btn'>Prev</span>").prependTo(pager);
			$("<span class='next-btn'>Next</span>").appendTo(pager);
			
			$(pager + ' .page_link:first').addClass('active');
			
			listElement.children().css('display', 'none');
			listElement.children().slice(0, perPage).css('display', 'block');
			
			$(pager + ' li a').click(function(){
			  var clickedPage = $(this).html().valueOf() - 1;
			  goTo(clickedPage,perPage);
			  $('.page_link').removeClass('activated');
			  $(this).addClass('activated');
			});
			
			$(pager + ' .prev-btn').click(function() {
				previous();
				
			});
			
			$(pager + ' .next-btn').click(function() {
				next();
				
			});
			
			function previous(){
			  console.log ("Previous");
			  var goToPage = parseInt($(pager).attr("curr")) - 1;
			  if($('.active').prev('.page_link').length==true){
			    goTo(goToPage);
			  }
			}
			
			function next(){
				console.log("Next");
			  goToPage = parseInt($(pager).attr("curr")) + 1;
			  if($('.active_page').next('.page_link').length==true){
			    goTo(goToPage);
			  }
			}
			
			function goTo(page){
			  var startAt = page * perPage,
			    endOn = startAt + perPage;
			  
			  listElement.children().css('display','none').slice(startAt, endOn).css('display','block');
			  $(pager).attr("curr",page);
			}
		}
		
		changePage($('.all'), '.pager-all');
		changePage($('.csc-content'), '.pager-content');
		changePage($('.csc-experience'), '.pager-experience');
		changePage($('.csc-full-service'), '.pager-full-service');
		changePage($('.csc-identity'), '.pager-identity');
		
		$('#content').append( $('.pagination-content') );
		$('#experience').append( $('.pagination-experience') );
		$('#full-service').append( $('.pagination-full-service') );
		$('#identity').append( $('.pagination-identity') );

} )( jQuery );