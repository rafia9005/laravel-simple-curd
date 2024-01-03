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
                                    <a href="/profile" class="d-flex align-items-center gap-2 dropdown-item">
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
            <h1 class="mb-5">Hi {{ $user->name }}, welcome to dashboard for {{ $user->role }}.</h1>
            <div class="row">
                <div class="col-lg d-flex align-items-strech">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Created</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Add this inside the <tbody> section of your table -->
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#editUserModal{{ $user->id }}">
                                                        Edit
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#deleteUserModal{{ $user->id }}">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Edit User Modal -->
                                            <div class="modal fade" id="editUserModal{{ $user->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content" style="border-radius: 5px;">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editUserModalLabel">Edit User
                                                                {{ $user->name }}
                                                            </h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('user.update', ['id' => $user->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label for="name"
                                                                        class="form-label">Name:</label>
                                                                    <input type="text" name="name"
                                                                        value="{{ $user->name }}"
                                                                        class="form-control" required>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="email"
                                                                        class="form-label">Email:</label>
                                                                    <input type="email" name="email"
                                                                        value="{{ $user->email }}"
                                                                        class="form-control" required>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="role"
                                                                        class="form-label">Role:</label>
                                                                    <select name="role" class="form-select"
                                                                        required>
                                                                        <option value="user"
                                                                            {{ $user->role === 'user' ? 'selected' : '' }}>
                                                                            User</option>
                                                                        <option value="admin"
                                                                            {{ $user->role === 'admin' ? 'selected' : '' }}>
                                                                            Admin</option>
                                                                    </select>
                                                                </div>


                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    <button type="submit"
                                                                        class="btn btn-primary w-50 py-2 fs-4 mb-4 rounded-2">Save
                                                                        Changes</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete User Modal -->
                                            <div class="modal fade" id="deleteUserModal{{ $user->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content" style="border-radius: 5px;">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteUserModalLabel">Delete
                                                                User</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete {{ $user->name }}?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <form
                                                                action="{{ route('user.delete', ['id' => $user->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $users->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-4"> --}}
                {{-- <div class="col-lg-12"> --}}
            </div>
            <div class="row">
                <div class="col-lg-8 d-flex align-items-strech">
                    <div class="card w-100">
                        <div class="card-body">
                            <h1>Layanan jual product & murah.</h1>
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
