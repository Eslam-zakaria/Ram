
<div class="support" data-aos="flip-down">
    <a class="support__block" href="tel:{{ settings()->get('common.phone') }}">
        <div class="support__logo">
            <svg class="icon">
                <use xlink:href="/web/assets/images/icons/kahhal-icons.svg#phone-icon"></use>
            </svg>
        </div>
        <div class="support__text">
            {{ __('messages.Phone support') }}
            <span>{{ settings()->get('common.phone') }}</span>
        </div>
    </a>
    <a class="support__block" href="{{ settings()->get('common.whatsapp') }}" target="_blank" >
        <div class="support__logo">
            <svg class="icon">
                <use xlink:href="/web/assets/images/icons/kahhal-icons.svg#whatsapp-icon"></use>
            </svg>
        </div>
        <div class="support__text">
            {{ __('messages.Message us on') }}
            <span>WhatsApp</span>
        </div>
    </a>
</div>
