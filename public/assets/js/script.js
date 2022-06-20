/**
 * Ini function untuk preview image di edit proifle
 */
function PreviewImage() {
  const profilePicture = document.querySelector('#foto');
  const imgPreview = document.querySelector('.img-preview');
  const file = new FileReader();
  file.readAsDataURL(profilePicture.files[0]);
  file.onload = function (e) {
    imgPreview.src = e.target.result;
  };
}

/**
 * Button sweet alert delete
 */
$(document).on('click', '.btn-hapus', function (e) {
  e.preventDefault();
  const href = $(this).attr('href');

  Swal.fire({
    title: 'Apa kamu yakin akan menghapus data ini?',
    text: 'Data tidak dapat dipulihkan kembali.',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, hapus',
    cancelButtonText: 'Batalkan',
  }).then((result) => {
    if (result.isConfirmed) {
      document.location.href = href;
    }
  });
});

/**
 * Alert CRUD
 */
const swal = $('.swal').data('swal');
if (swal) {
  Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: `${swal}`,
  });
}

// let url = window.location.href;

// let splitURL = url.split('/');
// let getURLSegment = splitURL[3];

// if (getURLSegment !== '') {
//   console.log(getURLSegment);
//   localStorage.setItem('sidebar', 'opened');
//   let sidebar = window.localStorage.getItem('sidebar');
//   // console.log('isi sidebar : ', sidebar);
//   if (sidebar === 'opened') {
//     $('.collapse').on('hidden.bs.collapse', function () {
//       // read the data-default value
//       var defaultDiv = $($(this).data('parent')).data('default');
//       // show the default panel
//       $('.collapse')
//         .eq(defaultDiv - 1)
//         .collapse('show');
//     });
//   }
// } else {
//   localStorage.removeItem('sidebar');
// }
