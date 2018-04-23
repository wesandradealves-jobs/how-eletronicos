jQuery(document).ready(function(){
  $("#menu li").addClass("flex25");  
  $("#menuFooter").prepend("<li><h2>How</h2></li>");
  $( ".page_id_12 .midnav a" ).on( "click", function() {
  	var value = $(this).attr("data-value");
  	if(value != "Todos"){
  		$("#produtos ul li").addClass("hidden");
  		$("#produtos ul li."+value).removeClass("hidden");
  	} else {
  		$("#produtos ul li").removeClass("hidden");
  	}
  });
  $( ".midnav a" ).on( "click", function() {
    $(".midnav li").removeClass("ativo");
    $(this).parent().addClass("ativo");
  });
  var grid = document.querySelector('.grid');
  var msnry = new Masonry( grid, {
  	itemSelector: '.grid-item',
  	columnWidth: '.grid-sizer',
  	percentPosition: true
  });	
  var sticky = new Waypoint.Sticky({
  	element: $('.midnav')[0],
  	handler: function(direction) {
  		if(direction == "down"){
  			$("header").addClass("hide");
  		} else {
  			$("header").removeClass("hide");
  		}
  	},
  	offset: 90 
  });
  function getRelatedContent(el){
    return $($(el).attr('href'));
  }

  function getRelatedNavigation(el){
    return $('body:not(.page_id_12)  .midnav a[href=#'+$(el).attr('id')+']');
  }

  $('body:not(.page_id_12) .midnav a').on('click',function(e){
    e.preventDefault();
    $('html,body').animate({scrollTop:getRelatedContent(this).offset().top - 100})
  });

  var wpDefaults={
    context: window,
    continuous: true,
    enabled: true,
    horizontal: false,
    offset: 0,
    triggerOnce: false
  };

  $('section').waypoint(function(direction) {
    getRelatedNavigation(this).parent().toggleClass('ativo', direction === 'down');
  }, {
    offset: '30%'
  }).waypoint(function(direction) {
    getRelatedNavigation(this).parent().toggleClass('ativo', direction === 'up');
  }, {
    offset: function() {  return -$(this).height() + 100; }
  }); 

  $("[name='locations']").change(function () {
    var locations = this.value;
    $("[data-type='locations']").not(this).hide();
    $("[data-type='locations'][data-value='"+locations+"']").show();
  });
  
  $("select[name='produtos']").find("option").not(':first-child').hide();

  $("select[name='produtos'] ~ [class*='btn']").hide();

  $("select[name='categorias']").change(function () {
    var cat = this.value;
    $("select[name='produtos']").find("option").not(':first-child').not("option."+cat).hide();
    $("select[name='produtos']").find("option."+cat).show();
  });

  $("select[name='produtos']").change(function () {
    var manual = this.value;
    $("select[name='produtos'] ~ [class*='btn']").hide();
    $("select[name='produtos'] ~ [class*='btn']."+manual).show();
  });
});
