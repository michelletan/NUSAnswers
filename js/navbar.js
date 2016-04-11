var slideout = new Slideout({
    'panel': document.getElementById('panel'),
    'menu': document.getElementById('mobile-menu'),
    'padding': 256,
    'tolerance': 70,
    'fx': 'slide'
 });

 $("#btn-toggle-menu").click(function(e) {
     e.preventDefault();
     slideout.toggle();
 });
