var url = window.location;
// for sidebar menu but not for treeview submenu
$('ul.sidebar-menu a').filter(function () {
    return this.href == url;
}).parent().siblings().removeClass('active').end().addClass('active');
// for treeview which is like a submenu
$('ul.treeview-menu a').filter(function () {
    return this.href == url;
}).parentsUntil(".sidebar-menu > .treeview-menu").siblings().removeClass('active menu-open').end().addClass('active menu-open');