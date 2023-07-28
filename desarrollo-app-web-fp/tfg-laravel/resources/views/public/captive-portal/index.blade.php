
@extends('layouts.captive-portal')

@section('title', 'Captive Portal')

@section('head')

    <script src="{{ asset('js/captive-portal.js') }}" type="text/javascript"></script>

@endsection

@section('content')
    <div id="areaForm">

        <div>

            <div id="clientLogo"><div></div></div>
            <div id="wifi">
                <img src="https://www.anuttarayoga.com/wp-content/uploads/2016/12/free-wifi.png">
            </div>
            <div class="ui form" id="formCheck">
                <div class="field">
                    <div class="ui checkbox">
                        <input id="acceptConditions" type="checkbox" name="acceptConditions">
                        <label>@lang('captive-portal.form.conditions')</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui radio">
                        <label>@lang('captive-portal.form.inhotel')</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="inhotel" type="radio" name="inhotel" value="0"> @lang('captive-portal.form.inhotelYes')&nbsp;&nbsp;&nbsp;
                        <input class="inhotel" type="radio" name="inhotel" value="1"> @lang('captive-portal.form.inhotelNo')
                    </div>
                </div>
                <div class="field" id="numRoomdiv">
                    <div class="ui left icon input">
                        <input id="numRoom" type="number" name="numRoom" min="1" max="100">
                        <label>@lang('captive-portal.form.numroom')</label>
                    </div>
                </div>
            </div>
            <div class="ui form" id="selectLogin">
                <div id="optionLoguin" class="text-center">
                    <!--<h2>@lang('captive-portal.form.facebook.tittle')</h2>-->
                    <div class="fb-login-button" data-size="large" data-button-type="login_with" data-auto-logout-link="true" data-use-continue-as="true" onlogin="checkLoginState()"></div>
                    <h3>@lang('captive-portal.form.register.o')</h3>
                    <button class="btn btn-primary py-2" id="loginbyform"><i class="fa fa-sign-in-alt" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@lang('captive-portal.form.register.button')</button>
                </div>
            </div>
            <div class="ui form" id="formClient">
                <div id="optionLoguin" class="text-center">
                    <h2>@lang('captive-portal.form.register.tittle')</h2>
                </div>
                <div class="field">
                    <label>@lang('captive-portal.form.name.tittle')</label>
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input id="clientName" type="text" name="name" placeholder="@lang('captive-portal.form.name.placeholder')" required>
                    </div>
                </div>
                <div class="field">
                    <label>@lang('captive-portal.form.surname.tittle')</label>
                    <div class="ui left icon input">
                        <i class="user plus icon"></i>
                        <input id="clientSurnames" type="text" name="surname" placeholder="@lang('captive-portal.form.surname.placeholder')" required>
                    </div>
                </div>
                <div class="field">
                    <label>@lang('captive-portal.form.email.tittle')</label>
                    <div class="ui left icon input">
                        <i class="envelope outline icon"></i>
                        <input id="clientEmail" type="text" name="email" placeholder="@lang('captive-portal.form.email.placeholder')" required>
                    </div>
                </div>
                <div class="field">
                    <label>@lang('captive-portal.form.gender.tittle')</label>
                    <div class="ui fluid search selection dropdown">
                        <input id="clientGender" type="hidden" name="gender" required>
                        <i class="dropdown icon"></i>
                        <div class="default text">
                            <i class="venus mars icon"></i>
                            @lang('captive-portal.form.gender.placeholder')
                        </div>
                        <div class="menu" style="max-height: 115px;">
                            <div class="item" data-value="1"><i class="mars icon"></i>@lang('captive-portal.form.gender.types.man')</div>
                            <div class="item" data-value="2"><i class="venus icon"></i>@lang('captive-portal.form.gender.types.woman')</div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label>@lang('captive-portal.form.birthdate.tittle')</label>
                    <div class="ui calendar calendarDate left icon input">
                        <i class="calendar icon"></i>
                        <input id="clientBirthdate" type="text" name="birthdate" placeholder="@lang('captive-portal.form.birthdate.placeholder')" required>
                    </div>
                </div>
                <div class="field">
                    <div id="checkboxCoditionsMinor" class="ui checkbox">
                        <input type="checkbox" name="acceptConditionsMinor" tabindex="0">
                        <label>@lang('captive-portal.form.conditions-minor')</label>
                    </div>
                </div>
                
                <button class="ui primary submit button" success>@lang('captive-portal.form.submit')</button>
                <!--<div class="sharethis-inline-share-buttons">Share</div>-->
                <a href="javascript: void(0);" id="buttonFacebook" onclick="window.open('http://www.facebook.com/sharer.php?u=https://portaldev.p.w34marketing.com/captive-portal/e2b11b93-e26f-4b96-afbd-00e228e8a1c1','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');">
                    <button>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 216 216" class="_5h0m" color="#FFFFFF">
                                <path fill="#FFFFFF" d="
                                M204.1 0H11.9C5.3 0 0 5.3 0 11.9v192.2c0 6.6 5.3 11.9 11.9
                                11.9h103.5v-83.6H87.2V99.8h28.1v-24c0-27.9 17-43.1 41.9-43.1
                                11.9 0 22.2.9 25.2 1.3v29.2h-17.3c-13.5 0-16.2 6.4-16.2
                                15.9v20.8h32.3l-4.2 32.6h-28V216h55c6.6 0 11.9-5.3
                                11.9-11.9V11.9C216 5.3 210.7 0 204.1 0z"></path>
                            </svg>
                            <span>&nbsp;&nbsp;&nbsp;Compartir en Facebook&nbsp;&nbsp;&nbsp;</span>
                    </button>
                </a>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/fbsdk.js') }}" type="text/javascript"></script>
@endsection