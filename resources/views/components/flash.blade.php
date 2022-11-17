@if (session()-> has ('success'))
    <div x-data="{show:true}"
         x-init="setTimeout(() => show = false, 3000)"
         x-show="show"
         class="fixed px-4 py-2 bg-blue-500 text-white rounded-xl mt-3 mx-5 text-s right-3 bottom-3">
        <p>{{session('success')}}</p>
    </div>
@endif
