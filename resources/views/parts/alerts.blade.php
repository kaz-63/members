
@if (session('nanoma_admin') === true)
<div class="alert alert-secondary text-center" role="alert">
	<p class="fw-bold m-0">管理者ログイン中</p>
</div>
@endif
@if (session('status'))
<div class="card-body text-center">
<div class="alert alert-success" role="alert">
	{{ session('status') }}
</div>
</div>
@endif
@if (session('success'))
<div class="card-body text-center">
<div class="alert alert-success" role="alert">
	{{ session('success') }}
</div>
</div>
@endif
@if (session('error'))
<div class="card-body text-center">
<div class="alert alert-danger" role="alert">
	{{ session('error') }}
</div>
</div>
@endif
