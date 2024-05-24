@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <button class="btn btn-sm btn-success mb-3" data-toggle="modal" data-target="#createEmployeeModal">Input
            Employee</button>
        <table class="table" id="employee-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>Status Perkawinan</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Create Employee Modal -->
    <div class="modal fade" id="createEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="createEmployeeModalLabel"
        aria-hidden="true">
        @include('employees._modals.create')
    </div>

    {{-- modal edit --}}
    <div class="modal fade" id="updateEmployeeModal" tabindex="-1" role="dialog"
        aria-labelledby="updateEmployeeModalLabel" aria-hidden="true">
        @include('employees._modals.edit')
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                var table = $('#employee-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('employees.index') }}',
                    columns: [{
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'tanggal_lahir',
                            name: 'tanggal_lahir'
                        },
                        {
                            data: 'alamat',
                            name: 'alamat'
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'status_perkawinan',
                            name: 'status_perkawinan'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                $('#createEmployeeForm').on('submit', function(e) {
                    e.preventDefault();

                    var formData = new FormData(this);
                    $.ajax({
                        url: "{{ route('employees.store') }}",
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $('#createEmployeeModal').modal('hide');
                            $('#employee-table').DataTable().ajax.reload();

                            // Menggunakan SweetAlert di sini
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data berhasil ditambahkan.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        },
                        error: function(response) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menambahkan data.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                });

                // Tambahkan event listener untuk tombol hapus
                $('#employee-table').on('click', '.delete-btn', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var url = "{{ url('employees') }}" + '/' + id;

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Anda tidak akan dapat mengembalikan tindakan ini!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                data: {
                                    "_token": "{{ csrf_token() }}"
                                },
                                success: function(data) {
                                    $('#employee-table').DataTable().ajax.reload();
                                    Swal.fire(
                                        'Terhapus!',
                                        'Data telah dihapus.',
                                        'success'
                                    );
                                },
                                error: function(data) {
                                    Swal.fire(
                                        'Gagal!',
                                        'Tidak dapat menghapus data.',
                                        'error'
                                    );
                                }
                            });
                        }
                    });
                });
            });


            // Function to fill update modal with employee data
            function fillUpdateModal(employee) {
                console.log(employee); // Pe
                $('#employeeId').val(employee.id);
                $('#updateNama').val(employee.nama);
                $('#updateTanggalLahir').val(employee.tanggal_lahir);
                $('#updateAlamat').val(employee.alamat);
                $('#updateStatusPerkawinan').val(employee.status_perkawinan ? '1' : '0');
                $('#updateEmployeeModal').modal('show');
            }

            $('#updateEmployeeForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var employeeId = $('#employeeId').val();
                $.ajax({
                    url: "{{ url('employees') }}/" + employeeId,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#updateEmployeeModal').modal('hide');
                        $('#employee-table').DataTable().ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Employee updated successfully.',
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while updating the employee.',
                        });
                    }
                });
            });

            // script show detail
            function showEmployeeDetails(employee) {
                var fotoUrl = employee.foto;
                console.log(fotoUrl)
                Swal.fire({

                    html: `
                    <div class="alert alert-primary" role="alert">
                        Employee Details
                    </div>


                    <div class="alert alert-secondary" role="alert">
                        <div class="row">
                            <div class="col-md-6 text-start">
                                Nama Karyawan: 
                            </div>
                            <div class="col-md-6 text-start">
                                ${employee.nama}
                            </div>
                            <div class="col-md-6 text-start">
                                Tanggal Lahir: 
                            </div>
                            <div class="col-md-6 text-start">
                                ${employee.tanggal_lahir}
                            </div>

                            <div class="col-md-6 text-start">
                                Alamat: 
                            </div>
                            <div class="col-md-6 text-start">
                                ${employee.alamat}
                            </div>

                            <div class="col-md-6 text-start">
                                Status Pernikahan: 
                            </div>
                            <div class="col-md-6 text-start">
                                ${employee.status_perkawinan ? 'Married' : 'Single'}
                            </div>

                            <img src="${fotoUrl}" style="max-width: 100%;" alt="Foto Karyawan">

                        </div>
                    </div>
            `,
                    showCloseButton: true,
                    showConfirmButton: false,
                });
            }
        </script>
    @endpush
@endsection
