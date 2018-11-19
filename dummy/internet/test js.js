 var animationSpeed    = 500;
var oldVisibleSiteId  = 0;
var newVisibleSiteId  = 0;
var intSiteId         = 0;


/*
 * ==========================================================================
 * Adjusting fake background height : header + max sitedesc height
 * ==========================================================================
*/
function adjustFakeBackground() {

  /* site header height */
  var fakeContentHeight   = $("div#FakeContent").height();
  var siteHeaderHeight    = $("div#MiniSiteHead").height();
  var headerHeight         = Math.max(fakeContentHeight, siteHeaderHeight);

  /* highest site desc height */
  var descHeight = 0;
  $('div[id^="MiniSiteDisp"]').each(function(){
    descHeight = Math.max(descHeight, $(this).height());
  });

  /* adjust height */
  $("div#FakeBackground").height(headerHeight + descHeight);
  $("div#FakeBackground").css("margin-top", -$("div#FakeContent").height() - 20);

  /* adjust page height */
  var oldPageHeight = $("div.page").height();
  $("div.page").css('height', '+=' + $("img#FakeBackGroundBot").height());
}


/* ========================================================================== */
/* to switch a miniside description
/* ========================================================================== */
function switchMinisiteDisp(oldMinisiteId, newMinisiteId) {

  $("div#MiniSiteDisp" + newMinisiteId).css('left' , '-10%');
  $("div#MiniSiteDisp" + newMinisiteId).css('opacity' , '0');

  /* hide old site */
  $("div#MiniSiteDisp" + oldMinisiteId).animate({"left": "+=45%", opacity: "0"}, animationSpeed);
  $("div#MiniSiteDisp" + oldMinisiteId).delay(animationSpeed/2).fadeOut("fast");
  /* $("div#MiniSiteDisp" + oldMinisiteId).fadeOut(animationSpeed); */

  /* show new site */
  /* $("div#MiniSiteDisp" + newMinisiteId).fadeIn(animationSpeed); */
  $("div#MiniSiteDisp" + newMinisiteId).show("fast");
  $("div#MiniSiteDisp" + newMinisiteId).animate({"left": '20%', opacity: "1"}, animationSpeed)
  
}





/* ========================================================================== */
/* HERE WE GO !!!!!!!!!!!! */
/* ========================================================================== */

$(document).ready(function() {

  /* =====================   MINISITE DISPLAY ============================  */

    oldVisibleSiteId = 0;
    newVisibleSiteId = 0;
    $("div#MiniSiteDisp0").fadeIn();
    $("div#MiniSiteDisp0").css("left", '20%');
    adjustFakeBackground();

    $('img[id^="SiteHeader"]').click(      function(){
        newVisibleSiteId = $(this).attr('id').substring(10);
        if( newVisibleSiteId !== oldVisibleSiteId){
          switchMinisiteDisp(oldVisibleSiteId, newVisibleSiteId);
        }
        oldVisibleSiteId = newVisibleSiteId;
    });



  /* =====================   MINISITE ADMINISTRATOR =======================  */

  /* ======================================================  */
  /* ===        if an minisite icon is hovered:         ===  */
  /* ======================================================  */
  $('p[id^="SiteName"]').click(function() {

    /* retrieve site id */
    intSiteId = $(this).attr("id").substring(8);

    if ($("div#SiteData" + intSiteId).is(":visible")) {
      $("div#SiteData" + intSiteId).slideUp(animationSpeed);
      $("div#SiteLang" + intSiteId).slideUp(animationSpeed);
      $("div#SiteDesc" + intSiteId).slideUp(animationSpeed);
      $("div#SiteAuth" + intSiteId).slideUp(animationSpeed);
      $("div#SiteClose" + intSiteId).slideUp(animationSpeed);
    }
    else{
      $("div#SiteData" + intSiteId).slideDown(animationSpeed);
      $("div#SiteLang" + intSiteId).slideDown(animationSpeed);
      $("div#SiteDesc" + intSiteId).slideDown(animationSpeed);
      $("div#SiteAuth" + intSiteId).slideDown(animationSpeed);
      $("div#SiteClose" + intSiteId).slideDown(animationSpeed);
    }
    });


  /* ======================================================  */
  /* ===        add more user auth entry                ===  */
  /* ======================================================  */
  $('p[id^="SiteAuthClick"]').click(function() {
    /* retrieve site id */
    intSiteId = $(this).attr("id").substring(13);
    $("table#SiteAuthTable" + intSiteId).append("<tr> " + $('tr#UserAuthAddEntry').html() + " </tr>");
  });


});












 