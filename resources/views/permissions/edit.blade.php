@extends('layout.base')

@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div class="card-header">
                            <div class="card-title">Permissions Management / Assign Permission</div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST"
                            action="{{ route('permissions.update', $role->id) }}">
                            @csrf

                            <div class="col-md-12">
                                <label for="exampleFormControlInput1">Role Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="exampleFormControlInput1" name="name" value="{{ $role->name }}" readonly>
                            </div>

                            <label for="permissions" class="form-label" style="margin-top:50px">Assign Permissions</label>
                            <hr />

                            <!-- dashboard -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.dashboards')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>
                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('dashboards.operational')" @if (in_array('dashboards.operational', $role_permissions)) checked @endif
                                                type="checkbox">
                                            @lang('role.dashboards.operational')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('dashboards.financial')" @if (in_array('dashboards.financial', $role_permissions)) checked @endif
                                                type="checkbox">
                                            @lang('role.dashboards.financial')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- users -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.users')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>
                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('users.view')" @if (in_array('users.view', $role_permissions)) checked @endif
                                                type="checkbox">
                                            @lang('role.users.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('users.create')" @if (in_array('users.create', $role_permissions)) checked @endif
                                                type="checkbox">
                                            @lang('role.users.create')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('users.update')" @if (in_array('users.update', $role_permissions)) checked @endif
                                                type="checkbox">
                                            @lang('role.users.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- roles-->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.user_roles')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>
                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('roles.view')" @if (in_array('roles.view', $role_permissions)) checked @endif
                                                type="checkbox">
                                            @lang('role.roles.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('roles.create')" @if (in_array('roles.create', $role_permissions)) checked @endif
                                                type="checkbox">
                                            @lang('role.roles.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('roles.update')" @if (in_array('roles.update', $role_permissions)) checked @endif
                                                type="checkbox">
                                            @lang('role.roles.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- permissions -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.permissions')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('permissions.view')" @if (in_array('permissions.view', $role_permissions)) checked @endif
                                                type="checkbox">
                                            @lang('role.permissions.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('permissions.create')"
                                                @if (in_array('permissions.create', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.permissions.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('permissions.update')"
                                                @if (in_array('permissions.update', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.permissions.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- customers -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.customers')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('customers.view')"
                                                @if (in_array('customers.view', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.customers.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('customers.create')"
                                                @if (in_array('customers.create', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.customers.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('customers.update')"
                                                @if (in_array('customers.update', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.customers.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- customer types -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.customer-types')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('customer-types.view')"
                                                @if (in_array('customer-types.view', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.customer-types.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('customer-types.create')"
                                                @if (in_array('customer-types.create', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.customer-types.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('customer-types.update')"
                                                @if (in_array('customer-types.update', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.customer-types.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- property types -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.property-types')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('property-types.view')"
                                                @if (in_array('property-types.view', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.property-types.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('property-types.create')"
                                                @if (in_array('property-types.create', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.property-types.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('property-types.update')"
                                                @if (in_array('property-types.update', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.property-types.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- property -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.properties')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('properties.view')"
                                                @if (in_array('properties.view', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.properties.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('properties.create')"
                                                @if (in_array('properties.create', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.properties.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('properties.update')"
                                                @if (in_array('properties.update', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.properties.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- business types -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.business-types')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('business-types.view')"
                                                @if (in_array('business-types.view', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.business-types.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('business-types.create')"
                                                @if (in_array('business-types.create', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.business-types.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('business-types.update')"
                                                @if (in_array('business-types.update', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.business-types.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- business classes -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.business-classes')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('business-classes.view')"
                                                @if (in_array('business-classes.view', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.business-classes.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('business-classes.create')"
                                                @if (in_array('business-classes.create', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.business-classes.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('business-classes.update')"
                                                @if (in_array('business-classes.update', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.business-classes.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- businesses-->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.businesses')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('businesses.view')"
                                                @if (in_array('businesses.view', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.businesses.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('businesses.create')"
                                                @if (in_array('businesses.create', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.businesses.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('businesses.update')"
                                                @if (in_array('businesses.update', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.businesses.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- bills -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.bills')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('bills.view')"
                                                @if (in_array('bills.view', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.bills.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('bills.create')"
                                                @if (in_array('bills.create', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.bills.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('bills.update')"
                                                @if (in_array('bills.update', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.bills.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- payments -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.payments')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('payments.view')"
                                                @if (in_array('payments.view', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.payments.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('payments.create')"
                                                @if (in_array('payments.create', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.payments.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('payments.update')"
                                                @if (in_array('payments.update', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.payments.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- assemblies -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.assemblies')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('assemblies.view')"
                                                @if (in_array('assemblies.view', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.assemblies.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('assemblies.create')"
                                                @if (in_array('assemblies.create', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.assemblies.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('assemblies.update')"
                                                @if (in_array('assemblies.update', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.assemblies.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- divisions -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.divisions')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('divisions.view')"
                                                @if (in_array('divisions.view', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.divisions.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('divisions.create')"
                                                @if (in_array('divisions.create', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.divisions.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('divisions.update')"
                                                @if (in_array('divisions.update', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.divisions.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- blocks -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.blocks')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('blocks.view')"
                                                @if (in_array('blocks.view', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.blocks.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('blocks.create')"
                                                @if (in_array('blocks.create', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.blocks.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('blocks.update')"
                                                @if (in_array('blocks.update', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.blocks.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- zones -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.zones')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('zones.view')"
                                                @if (in_array('zones.view', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.zones.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('zones.create')"
                                                @if (in_array('zones.create', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.zones.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('zones.update')"
                                                @if (in_array('zones.update', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.zones.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- property-uses -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.property-uses')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('property-uses.view')"
                                                @if (in_array('property-uses.view', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.property-uses.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('property-uses.create')"
                                                @if (in_array('property-uses.create', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.property-uses.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('property-uses.update')"
                                                @if (in_array('property-uses.update', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.property-uses.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- rates -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.rates')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('rates.view')"
                                                @if (in_array('rates.view', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.rates.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('rates.create')"
                                                @if (in_array('rates.create', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.rates.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('rates.update')"
                                                @if (in_array('rates.update', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.rates.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- reports -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.reports')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('reports.view')"
                                                @if (in_array('reports.view', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.reports.view')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- customer types -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.agent-assignments')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('agent-assignments.view')"
                                                @if (in_array('agent-assignments.view', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.agent-assignments.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('agent-assignments.create')"
                                                @if (in_array('agent-assignments.create', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.agent-assignments.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('agent-assignments.update')"
                                                @if (in_array('agent-assignments.update', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.agent-assignments.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>

                            <!-- customer types -->
                            <div class="check_group">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h5>@lang('role.task-assignments')</h5>
                                    </div>

                                    <div class="col-md-2 text-center">
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input check_all" id="chk-ani " type="checkbox">
                                            @lang('role.select_all')
                                        </label>

                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('task-assignments.view')"
                                                @if (in_array('task-assignments.view', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.task-assignments.view')
                                        </label>
                                        <label class="d-block" for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('task-assignments.create')"
                                                @if (in_array('task-assignments.create', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.task-assignments.create')
                                        </label>
                                        <label for="chk-ani">
                                            <input class="form-check-input" name="permissions[]" id="chk-ani"
                                                value="@lang('task-assignments.update')"
                                                @if (in_array('task-assignments.update', $role_permissions)) checked @endif type="checkbox">
                                            @lang('role.task-assignments.update')
                                        </label>
                                    </div>
                                </div>
                                <hr />
                            </div>


                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Update Permission</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="{{ asset('assets/js/permission/role.js') }}"></script>
@endsection
