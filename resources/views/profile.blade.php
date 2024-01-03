@extends('layouts.head')

@section('content')
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="../assets/images/logos/dark-logo.svg" width="180" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                @if ($user->role === 'admin')
                    @include('components.admin.sidebar')
                @else
                    @include('components.user.sidebar')
                @endif
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <p class="mt-3">{{ $user->name }}</p>
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    @if ($user->profile_image_path)
                                        <img src="{{ Storage::url($user->profile_image_path) }}" alt="user-avatar"
                                            width="35" height="35" class="rounded-circle" />
                                    @else
                                        <img src="./assets/images/profile-default.png" alt="default-avatar" width="35"
                                            height="35" class="rounded-circle" />
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a>
                                        <a href="/logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->
                <div class="row">
                    <div class="content-wrapper">


                        <div class="container-xxl flex-grow-1 container-p-y">
                            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Profile /</span> {{ $user->name }}</h4>
                            <div class="card mb-4">
                                <h5 class="card-header">Profile Details</h5>
                                <!-- Account -->
                                <div class="card-body">
                                    <form id="formAccountSettings" method="POST" action="{{ route('profile.image.update') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                                            @if ($user->profile_image_path)
                                            <img src="{{ Storage::url($user->profile_image_path) }}" alt="user-avatar" class="d-block rounded" height="120" width="120" />
                                            @else
                                            <img src="./assets/images/profile-default.png" alt="default-avatar" class="d-block rounded" height="120" width="120" id="previewImage" style="display: none;" />
                                            @endif
                                            <div class="button-wrapper">
                                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                    <i class="fa-solid fa-upload"></i>
                                                    <i class="bx bx-select d-block d-sm-none"></i>
                                                    <input type="file" id="upload" name="profile_image" class="account-file-input" accept="image/png, image/jpeg" style="display: none" onchange="displayFileName(event)" id="uploadFoto" />
                                                </label>
                                                <button type="submit" class="btn btn-outline-secondary account-image-reset mb-4">
                                                    <i class="bx bx-upload d-block"></i>
                                                    <span class="d-sm-block">Upload</span>
                                                </button>
                                                <p id="file-name-display">Pilih file untuk upload</p>
                                                <p class="text-muted mb-0">Allowed JPG, GIF, or PNG. Max size of 800K</p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <hr class="my-0" />
                                <div class="card-body">
                                    <form id="formAccountSettings" method="POST" action="{{ route('profile.update') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="name" class="form-label">Name</label>
                                                <input class="form-control" type="text" id="name" name="name"
                                                    value="{{ $user->name }}" autofocus />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input class="form-control" type="text" id="email" name="email"
                                                    value="{{ $user->email }}" />
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                        </div>
                                    </form>
                                </div>

                                <h5 class="card-header mt-5">Change Password</h5>
                                <div class="card-body">
                                    @if (session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <form id="formAccountSettings" method="POST"
                                        action="{{ route('profile.updatePassword') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="new_password" class="form-label">New password</label>
                                                <input class="form-control" type="password" id="new_password"
                                                    name="new_password" required />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="confirm_password" class="form-label">Confirm password</label>
                                                <input type="password" class="form-control" id="confirm_password"
                                                    name="confirm_password" required />
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2">Change</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /Account -->
                            </div>
                            <div class="card">
                                <h5 class="card-header">Delete Account</h5>
                                <div class="card-body">
                                    <div class="mb-3 col-12 mb-0">
                                        <div class="alert alert-warning">
                                            <h6 class="alert-heading mb-1">Are you sure you want to delete your account?
                                            </h6>
                                            <p class="mb-0">Once you delete your account, there is no going back. Please
                                                be
                                                certain.</p>
                                        </div>
                                    </div>
                                    <form id="formAccountDeactivation" onsubmit="return false">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="accountActivation"
                                                id="accountActivation" />
                                            <label class="form-check-label" for="accountActivation">I confirm my account
                                                deactivation</label>
                                        </div>
                                        <button type="submit" class="btn btn-danger deactivate-account">Deactivate
                                            Account</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">This source code created by <a href="https://rafii.site/" target="_blank"
                            class="pe-1 text-primary text-decoration-underline">www.rafii.site</a></p>
                </div>
            </div>
        </div>
    </div>
    <script>
        function displayFileName(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('file-name-display').innerText = input.files[0].name;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        let viewFoto = document.getElementById('viewFoto');
        let uploadFoto = document.getElementById('uploadFoto');

        uploadFoto.onchange = (e) => {
            if (input.files[0])
                viewFoto.src = URL.createObjectURL(input.files[0])
        }
        function displayImagePreview(event) {
            var input = event.target;
            var file = input.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var previewElement = document.getElementById('previewImage');
                    previewElement.src = e.target.result;
                    previewElement.style.display = 'block';
                };

                reader.readAsDataURL(file);
            }
        }

        function displayFileName(event) {
            var fileNameDisplay = document.getElementById('file-name-display');
            var fileName = event.target.files[0].name;
            fileNameDisplay.textContent = fileName;

            displayImagePreview(event);
        }
    </script>
@endsection
