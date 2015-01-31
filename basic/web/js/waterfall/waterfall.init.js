$(function() {
    var masonryNode = $('#w0');
    masonryNode.imagesLoaded(function(){
        masonryNode.masonry({
            itemSelector: '.item',
  			columnWidth: 0
        });
    });
     
     
});