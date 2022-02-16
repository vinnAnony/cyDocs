
exports.cyDocsAlert = (icon,title) => {
    Vue.swal({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        icon: icon,
        title: title
    });
};
