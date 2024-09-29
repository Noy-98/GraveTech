// Other JavaScript code of your material-dashboard-2.js file

// Scrollbar initialization code
var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
  var options = {
    damping: '0.5'
  };
  Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}

// More JavaScript code if any
