@if (session('success'))
<div class="alert alert-success alert-block" style="margin-top: 20px;">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{session('success')}}</strong>
</div>
@endif

@if (session('status'))
<div class="alert alert-success alert-block" style="margin-top: 20px;">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{session('status')}}</strong>
</div>
@endif
  
@if (session('error'))
<div class="alert alert-danger alert-block" style="margin-top: 20px;">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{session('error')}}</strong>
</div>
@endif

@if (session('not_verified'))
<div class="alert alert-danger alert-block" style="margin-top: 20px;">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>You need to verify your email address</strong>
</div>
@endif
   
@if (session('warning'))
<div class="alert alert-warning alert-block" style="margin-top: 20px;">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{ session('warning') }}</strong>
</div>
@endif
   
@if (session('info'))
<div class="alert alert-info alert-block" style="margin-top: 20px;">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{ $message }}</strong>
</div>
@endif
  
{{-- @if ($errors->any())
    <div class="alert alert-danger alert-block">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert">×</button>    
    </div>
@endif --}}