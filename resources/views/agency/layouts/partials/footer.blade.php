<footer class="footer px-4">
    <div>
        <a href="#">{{ auth()->user()->agency->agency_name ?? __('agency.layout.agency') }}</a> &copy;
        {{ date('Y') }}.
    </div>
    <div class="ms-auto">@lang('agency.layout.powered_by')&nbsp;<a href="#">@lang('agency.layout.aqar_vision')</a></div>
</footer>
