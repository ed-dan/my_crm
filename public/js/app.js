

$('.show-alert-delete-box').click(function(event){
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: "Are you sure you want to delete this record?",
        text: "If you delete this, it will be gone forever.",
        setBackgroundColor: '#d33',
        type: "warning",
        buttons: ["Cancel","Yes!"],
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
    });
});
//
// <script type="text/javascript">
//
//     var path = "{{ route('autocomplete') }}";
//
//     $("#search").autocomplete({
//     source: function (request, response) {
//     $.ajax({
//     url: path,
//     type: 'GET',
//     dataType: "json",
//     data: {
//     search: request.term
// },
//     success: function (data) {
//     response(data);
// }
// });
// },
//     select: function (event, ui) {
//     $('#search').val(ui.item.label);
//     console.log(ui.item);
//     return false;
// }
// });
// </script>

