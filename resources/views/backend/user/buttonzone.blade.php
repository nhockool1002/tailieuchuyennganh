								<div class="buttonzone">
                                <a href="{{ route('addUser') }}" class="btn btn-sm btn-warning pull-right"><i class="ti-plus"> Add User</i></a>
                                <a href="{{ route('filterUser') }}" class="btn btn-sm btn-success pull-right"><i class="ti-search"> Filter User</i></a>
                                @if(Request::is('backend/filter*'))
                                <a href="{{ route('user') }}" class="getAdminList btn btn-sm btn-dark pull-right"><i class="ti-user"> User List</i></a>
                                @endif
                                @if(Request::is('backend/user*'))
                                <a href="{{ route('filterAdmin') }}" class="getAdminList btn btn-sm btn-dark pull-right"><i class="ti-crown"> Admin List</i></a>
                                @endif
                                </div>