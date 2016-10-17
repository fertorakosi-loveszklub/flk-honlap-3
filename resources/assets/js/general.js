$(document).ready(() => {
    let $mainMenu = $("#main-menu-row nav");
    let $menuToggle = $("#main-menu-toggle");

    $menuToggle.click((e) => {
        e.preventDefault();
        $menuToggle.toggleClass("toggled");
        $mainMenu.toggleClass("toggled");
    });

    var stickyHeaderTop = $mainMenu.offset().top;
    var stickyHeaderWidth = $mainMenu.width();
    var stickyHeaderHeight = $mainMenu.height();

    $(window).scroll(function(){
        if( $(window).scrollTop() > stickyHeaderTop ) {
            $mainMenu.css({
                position: 'fixed',
                top: '0px',
                width: stickyHeaderWidth
            });

            $("body").css({'padding-top': stickyHeaderHeight});
        } else {
            $mainMenu.css({
                position: 'static',
            });
            $("body").css({'padding-top': 0});
        }
    });

});
