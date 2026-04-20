@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div id="alertBox" class="alert-custom"></div>

    <div class="admin-card">
        <div class="admin-card-header">
            <div class="admin-card-title">
                <i class="bi bi-mortarboard"></i> Data Education
            </div>
            <button class="btn-primary-custom" onclick="openForm()">
                <i class="bi bi-plus"></i> Tambah
            </button>
        </div>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Degree</th>
                        <th>Sekolah</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="eduTable"></tbody>
            </table>
        </div>
    </div>

</div>

<!-- MODAL -->
<div class="modal fade" id="eduModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Education</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" id="eduId">

        <label class="form-label">Degree</label>
        <input type="text" id="degree" class="form-control mb-2">

        <label class="form-label">School</label>
        <input type="text" id="school" class="form-control mb-2">

        <label class="form-label">Start</label>
        <input type="text" id="start" class="form-control mb-2">

        <label class="form-label">End</label>
        <input type="text" id="end" class="form-control">
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn-primary-custom" onclick="save()">Simpan</button>
      </div>
    </div>
  </div>
</div>

@endsection


@push('scripts')
<script>

let modal = new bootstrap.Modal(document.getElementById('eduModal'));

function loadData(){
    ajaxJson('GET', '{{ route("admin.api.education") }}', null, function(s,res){
        let html='';
        res.data.forEach(e=>{
            html+=`
            <tr>
                <td>${e.degree}</td>
                <td>${e.school}</td>
                <td>${e.year_start} - ${e.year_end}</td>
                <td>
                    <button class="btn-edit-custom" onclick='edit(${JSON.stringify(e)})'>Edit</button>
                    <button class="btn-danger-custom" onclick='hapus(${e.id})'>Hapus</button>
                </td>
            </tr>`;
        });
        document.getElementById('eduTable').innerHTML=html;
    });
}

function openForm(){
    document.getElementById('eduId').value='';
    document.getElementById('degree').value='';
    document.getElementById('school').value='';
    document.getElementById('start').value='';
    document.getElementById('end').value='';
    modal.show();
}

function edit(e){
    document.getElementById('eduId').value=e.id;
    document.getElementById('degree').value=e.degree;
    document.getElementById('school').value=e.school;
    document.getElementById('start').value=e.year_start;
    document.getElementById('end').value=e.year_end;
    modal.show();
}

function save(){
    let id = document.getElementById('eduId').value;

    let data={
        degree: document.getElementById('degree').value,
        school: document.getElementById('school').value,
        year_start: document.getElementById('start').value,
        year_end: document.getElementById('end').value
    };

    let url = id ? `/admin/api/education/${id}` : `/admin/api/education`;
    let method = id ? 'PUT' : 'POST';

    ajaxJson(method, url, data, function(s,res){
        if(res.success){
            modal.hide();
            loadData();
        }
    });
}

function hapus(id){
    if(!confirm('Hapus data?')) return;

    ajaxJson('DELETE', `/admin/api/education/${id}`, null, function(s,res){
        loadData();
    });
}

loadData();

</script>
@endpush