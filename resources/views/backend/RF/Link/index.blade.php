@extends('backend.back_layouts')
@section('headname')
	Links Manager
@endsection
@section('content')
	@include('backend.RF.Link.content')
@endsection
@push('scripts')
<script type="text/javascript" src="https://unpkg.com/tabulator-tables@5.5.2/dist/js/tabulator.min.js"></script>
<script>
  const getAllLink = "{{ route('link_creator.getAllLink') }}";
  const createLink = "{{ route('link_creator.createLink') }}";
  const deleteLink = "{{ route('link_creator.deleteLink') }}";
  const generateBtn = $('.generate-btn');
  const $name = $('#link_name');
  const $nameError = $('.name-error');
  const $urlError = $('.url-error');
  const $url = $('#link_origin');

  generateBtn.click(async function() {
  showLoading();
  const isValid = validate();
  if (isValid) {
    try {
      const res = await axios.post(createLink, { name: $name.val(), url: $url.val() });
      console.log(res.data);
      toastr.success('Link đã được tạo và cập nhật vào danh sách...', '[Create Link Success]');
      $name.val('');
      $url.val('');
      $nameError.text('');
      $urlError.text('');
      await funcGetAllLink(table);
    } catch (error) {
      console.log(error);
      toastr.error('Đã có lỗi xảy ra trong quá trình tạo link...', '[Create Link Failed]');
    } finally {
      hideLoading();
    }
  } else {
    hideLoading();
  }
});

  const funcGetAllLink = (table) => {
    showLoading();
    axios.get(
      getAllLink
    ).then((res) => {
      console.log(res.data);
      table.setData(res.data);
      hideLoading();
    }).catch((error) => {
      console.log(error);
      toastr.error('Lấy toàn bộ link thất bại...', '[Get All Linkn Failed]');
    })
  }

  const funcDeleteLink = (id) => {
    showLoading();
    axios.post(
      deleteLink,
      { id }
    ).then((res) => {
      toastr.success('Đã xoá link thành công...', '[Remove Link Success]');
      funcGetAllLink(table);
      hideLoading();
    }).catch(() => {
      toastr.error('Quá trình xoá link thất bại...', '[Create Link Failed]');
    })
  }

  const validate = ()  => {
    let isValid = true;

    // Validate name
    if($name.val().trim() === '') {
      $nameError.text('Name không được để trống');
      isValid = false;
    } else if ($name.val().length > 255) {
      $nameError.text('Name không được quá 255 ký tự');
      isValid = false;
    } else {
      $nameError.text('');
    }

    // Validate url
    const urlRegex = /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/;

    if ($url.val().trim() === '') {
      $urlError.text('URL không được để trống');
      isValid = false; 
    } else if (!urlRegex.test($url.val())) {
      $urlError.text('URL không đúng định dạng');
      isValid = false;
    } else {
      $urlError.text('');
    }

    return isValid;
  }

  var table = new Tabulator("#example-table", {
      layout: "fitColumns",
      responsiveLayout: "hide",
      addRowPos: "top",
      history: true,
      pagination: "local",
      paginationSize: 50,
      paginationCounter: "rows",
      movableColumns: true,
      initialSort: [
          { column: "name", dir: "asc" },
      ],
      columnDefaults: {
          tooltip: true,
      },
      columns: [
          { title: "Name", field: "name", editor: false },
          { title: "Origin", field: "origin", editor: false, formatter: "link" },
          { title: "Short Link", field: "short_link", editor: false, formatter: "link" },
          { title: "Go Link", formatter:function(row){
            return `<div'>
                <a href="{{ env('APP_URL') . '/go/'}}${row.getData().hash ?? ''}">[GO]</a>
              </div>`; 
          }},
          { title: "Created By", field: "created_by", editor: false },
          { title: "Delete", formatter:function(row){
            return `<div class="deleteBtn" onClick="testClick(${row.getData().id})"'>
                <i class="fa fa-trash fa-2x"></i>
              </div>`; 
          }}
      ],
  });

  function testClick(id) {
    if (confirm('Are you sure you want to delete?')) {
      funcDeleteLink(id);
    } 
  }

  funcGetAllLink(table);
</script>
@endpush
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabulator/5.5.2/css/tabulator_semanticui.min.css" integrity="sha512-Jtr8Z8Is4xn7MvlAVvx9ZgDGBFVxfMPemjbGa0uk862EAqhzYEGZlrbM53UVY0Pb7skBdFJzUEzffO9VKH+unA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
