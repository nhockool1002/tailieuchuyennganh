<footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>

                        <li>
                            @if(!empty($settingConfig['backend_bottom_1']['config_setting']))
                                {!! $settingConfig['backend_bottom_1']['config_setting'] !!}
                            @endif
                        </li>
                        <li>
                            @if(!empty($settingConfig['backend_bottom_2']['config_setting']))
                                {!! $settingConfig['backend_bottom_2']['config_setting'] !!}
                            @endif
                        </li>
                        <li>
                            @if(!empty($settingConfig['backend_bottom_3']['config_setting']))
                                {!! $settingConfig['backend_bottom_3']['config_setting'] !!}
                            @endif
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    @if(!empty($settingConfig['backend_credit']['config_setting']))
                        {!! $settingConfig['backend_credit']['config_setting'] !!}
                    @endif
                </div>
            </div>
        </footer>