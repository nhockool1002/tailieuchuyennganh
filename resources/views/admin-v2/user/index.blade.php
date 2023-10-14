@extends('admin-v2.admin_layouts')
@section('PAGE_TITLE')
  User Settings
@endsection
@section('CONTENT')
<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12 stretch-card">
      <div class="card">
        <div class="card-body">
          <h2 class="page-content-title">Users Management</h2>
          <div class="table-responsive">
            <table class="table table-hover table-white" id="userTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Join Date</th>
                  <th>Permission</th>
                  <th>Upgrade</th>
                  <th>Option</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->username }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->created_at }}</td>
                  <td>
                    @if (isset($user->getRoleNames()[0]))
                      {{ convertRoleToRoleName($user->getRoleNames()[0]) }}
                    @else
                      <i>Not set</i>
                    @endif
                  </td>
                  <td>
                    @if($user->hasRole(['member']))
                        <form method="POST" action={{ route('upgradeVip', ['id' => $user->id]) }}>
                            @csrf
                            <button type="submit" class="btn btn-vip" data-toggle="tooltip" title="Upgrade to VIP Member">
                              <span class="mdi mdi-shield-crown upgrade-vip-icon"></span>
                            </button>
                        </form>
                    @endif
                    @if($user->hasRole(['vip-member']))
                        <form method="POST" action={{ route('downgradeVip', ['id' => $user->id]) }}>
                            @csrf
                            <button type="submit" class="btn btn-vip" data-toggle="tooltip" title="Downgrade to Member">
                              <span class="mdi mdi-cog-stop downgrade-vip-icon"></span>
                            </button>
                        </form>
                    @endif
                  </td>
                  <td>
                    <span 
                      class="mdi mdi-pencil-circle edit-user-icon btnEditUser"
                      data-toggle="tooltip"
                      title="Edit user {{ $user->username }}"
                      data-target="#modalEditUser"
                      data-id="{{ $user->id }}"
                    >
                    </span>
                    <span class="mdi mdi-account-remove remove-user-icon" data-toggle="tooltip" title="Delete user {{ $user->username }}"></span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>  
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@section('CUSTOM_JS')
  @include('admin-v2.user.js')
@endsection
@include('admin-v2.user.partials.edit_user')
@endsection
