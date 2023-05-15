<form method="post" action="{{ route('api.leads.store') }}" class="form">
    @csrf
    <input type="hidden" name="source" value="{{ request()->get('source') }}">
    <input type="hidden" name="sourceid" value="{{ request()->get('sourceid') }}">
    <input type="hidden" name="urlsourceid" value="{{ request()->get('urlsourceid') }}">
    <input type="hidden" name="branche_id" value="18">

    <div class="form">
        <div class="form-group" data-aos="fade-up" data-aos-delay="100">
            <input type="text" name="name" class="form-control" id="fName" placeholder="الإسم بالكامل"
                   required  autocomplete="off">
        </div>
        <div class="form-group" data-aos="fade-up" data-aos-delay="200">
            <input type="tel" required name="phone"  class="form-control" id="pNumber" placeholder="رقم الجوال"
                   autocomplete="off">
        </div>
        <div class="form-group" data-aos="fade-up" data-aos-delay="300">
            <select name="offer_id" class="custom-select form-control">
                <option selected="">العرض</option>
                @foreach($offers as $offer)
                    <option value="{{ $offer->id }}">{{ $offer->name }}  ({{ $offer->price }}) ريال </option>
                @endforeach

            </select>
        </div>
        <div class="form-group" data-aos="fade-up" data-aos-delay="400">
            <button type="submit" class="btn btn-dark-gradient btn-lg" id="book-msg-toggle">
                {{ trans_choice('messages.choosenow', $page->gender) }}
            </button>
        </div>
    </div>
</form>
<!-- // form -->
