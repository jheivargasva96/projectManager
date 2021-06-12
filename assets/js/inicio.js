// $(document).ready(function() {
//     $(".control-sidebar-subheading [data-layout='fixed']").click();
// });

// $("[id=actualizar_password]").on("click", function (e) {
//     e.preventDefault();
//     $("#modal_password .modal-content").load('Cinicio/ModalPassword', function () {
//         $("#modal_password").modal({
//             backdrop: 'static',
//             keyboard: true,
//             show: true
//         });
        
//         $("[id=guardarRegistro]").on("click", function (e) {
//             e.preventDefault();
//             console.log($("#frmRegistro").serialize());
//             $.ajax({
//                 url: base_url() + "Cusuario/newPassword",
//                 type: "POST",
//                 data: $("#frmRegistro").serialize(),
//                 success: function (resultado) {
//                     var datos = JSON.parse(resultado);
//                     if (datos.success == true) {
//                         alertify.success("Guardado correctamente.");
//                         $('#modal_password').modal('toggle');
//                     } else {
//                         alertify.error('¡Error!, el Usuario no ha podido ser guardado, comuniquese con el adminsitrador del sistema.');
//                         return false;
//                     }
//                 },
//                 error: function (error) {
//                     alertify.error('Ocurrio un Error');
//                     return false;
//                 }
//             });
//         });
//     });
// });