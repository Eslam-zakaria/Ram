
<form method="post" action="{{ route('api.leads.store') }}" class="form">
    @csrf
    <input type="hidden" name="source" value="{{ request()->get('source') }}">
    <input type="hidden" name="sourceid" value="{{ request()->get('sourceid') }}">
    <input type="hidden" name="urlsourceid" value="{{ request()->get('urlsourceid') }}">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" name="name" required class="form-control" placeholder="الاسم بالكامل"
                       autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="tel" class="form-control" required name="phone" placeholder="رقم الجوال"
                       autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <select name="branche_id" required class="custom-select form-control">
                    <option selected>{{ trans_choice('messages.choose', $page->gender) }} الفرع</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <select name="offer_id" required class="custom-select form-control">
                    <option selected>{{ trans_choice('messages.choose', $page->gender) }} العرض</option>
                    @foreach($offers as $offer)
                        <option value="{{ $offer->id }}">{{ $offer->name }}  ({{ $offer->price }}) ريال </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-brown">{{ trans_choice('messages.choosenow', $page->gender) }}</button>
</form>
