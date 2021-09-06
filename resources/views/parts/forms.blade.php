{{--
	@include('parts.forms',[ 'title'=>'','name'=>'','value'=>'', ])
	@include('parts.forms',[ 'type'=>'textarea','title'=>'','name'=>'','value'=>'', ])
	@include('parts.forms',[ 'type'=>'quill','quill_name'=>'','title'=>'','name'=>'','value'=>''])
	@include('parts.forms',[ 'type'=>'input','input_type'=>'','name'=>'','value'=>'', ])
	@include('parts.forms',[ 'type'=>'checkbox','title'=>'','name'=>'','values'=>[ ['VALUE','TEXT'],['VALUE','TEXT'] ], ])
	@include('parts.forms',[ 'type'=>'radio','title'=>'','name'=>'','values'=>[ ['VALUE','TEXT'],['VALUE','TEXT'] ], ])
	@include('parts.forms',[ 'type'=>'select','title'=>'','name'=>'','values'=>[ ['VALUE','TEXT'],['VALUE','TEXT'] ], ])

	@include('parts.forms',[ 'type'=>'plural','plural_type'=>'','title'=>'',
		'name'=>'plural[]','placeholder'=>'','extra'=>'',
		'name2'=>'plural2[]','placeholder2'=>'','extra2'=>'',
	])



	@include('parts.forms', [
		'nonblock'=>'', //form_blockとして扱うか
		'type'=>'',
		'text'=>'',
		'title'=>'',
		'name'=>'',
		'value'=>'',
		'values'=>[ ['VALUE','TEXT'], ... ['',''] ]
		'placeholder'=>'',
		'id'=>'',
		'class'=>'',
		'extra'=>'',
		'max'=>'',
		'min'=>'',
		'required' =>''
		])

--}}
@php
	$as_block = isset($nonblock) ? false : true;
	$type = empty($type) ? 'text' : $type;
	$input_type = empty($input_type) ? '' : $input_type;
	$title = empty($title) ? '' : $title;
	$text = empty($text) ? '' : $text;
	$name = empty($name) ? '' : $name;
	$name2 = empty($name2) ? '' : $name2;
	if(strpos($name,'[') !== false){
		$name_forCode = str_replace(['[',']'],['.',''],$name);
	}else {
		$name_forCode = $name;
	}
	$value = empty($value) ? old($name_forCode) : $value;
	$value2 = empty($value2) ? old($name_forCode) : $value2;
	$values = empty($values) ? [[$value,$title]] : $values;
	$placeholder = empty($placeholder) ? '' : $placeholder;
	$placeholder2 = empty($placeholder2) ? '' : $placeholder2;
	$class = empty($class) ? '' : $class;
	$id = empty($id) ? 'form-'.$name : $id;
	$katakana = isset($katakana) ? ' pattern="(?=.*?[\u30A1-\u30FC])[\u30A1-\u30FC\s]*"' : '';
	$katakana2 =  isset($katakana2) ? ' pattern="(?=.*?[\u30A1-\u30FC])[\u30A1-\u30FC\s]*"' : '';
	$extra = empty($extra) ? '' : $extra;
	$extra .= $katakana;
	$extra2 = empty($extra2) ? '' : $extra2;
	$extra2 .= $katakana2;
	$required = isset($required) ? 'required' : '';
	$sortable = isset($sortable) ? 'sortable' : '';
	$plural_type = empty($plural_type) ? 'text' : $plural_type;
	$maxcount = empty($maxcount) ? 20 : $maxcount;

	
	$withImage = isset($withImage) ? 'withImage' : '';

	if(!empty($maxlength)){
		if(empty($minlength)){
			$extra .= ' onchange="LengthValidate(this,0,'.$maxlength.')" onkeyup="LengthValidate(this,0,'.$maxlength.')"';
		}else{
			$extra .= ' onchange="LengthValidate(this,'.$minlength.','.$maxlength.')" onkeyup="LengthValidate(this,'.$minlength.','.$maxlength.')"';
		}
	}
@endphp
@switch($type)
@case('shop_token')
	<input type="hidden" name="shop_token" value="{{ base_convert( session('shop_id',0) + 99999, 10, 36 ) }}">
	@break
@case('submit')
	<div class="col-12">
		<button type="submit" name="submitted" id="submit_btn" class="btn btn-primary {{$class}}">保存</button>
	</div>
	@break
@case('text')
	@if($as_block)<div class="form_block row g-3">@endif
		<div class="">
			@empty($title) @else <label class="{{$required}}" for="{{$id}}">{{$title}}</label> @endempty
			@empty($text) @else <p>{{$text}}</p> @endempty
			<input type="text" class="form-control {{$class}}" id="{{$id}}" name="{{$name}}" value="{{$value}}" 
			placeholder="{{$placeholder}}" {!! $extra !!} {{$required}}>
			<p class="formValidate_msg"> @error($name_forCode) {{ $message }} @enderror </p>
		</div>
	@if($as_block)</div>@endif
	@break
@case('textarea')
	@if($as_block)<div class="form_block row g-3">@endif
		<div class="">
			@empty($title) @else <label class="{{$required}}" for="{{$id}}">{{$title}}</label> @endempty
			@empty($text) @else <p>{{$text}}</p> @endempty
			<textarea class="form-control {{$class}}" id="{{$id}}" name="{{$name}}" rows="3" placeholder="{{$placeholder}}"
			{!! $extra !!} {{$required}}>{!!$value!!}</textarea>
			<p class="formValidate_msg"> @error($name_forCode) {{ $message }} @enderror </p>
		</div>
	@if($as_block)</div>@endif
	@break
@case('quill')
	<div id="quill_{{$quill_name}}_block" class="{{$withImage}}">
		<div class="form_block row g-3">
			<div class="p-0" style="max-height:50vh;">
				@empty($title) @else <label {{-- class="{{$required}}" --}} style="padding-left:2px">{{$title}}</label> @endempty
				@empty($text) @else <p>{{$text}}</p> @endempty
				<div id="quill_{{$quill_name}}_editor" class="quill_content" style="height:auto;">{!!$value!!}</div>
			</div>
		</div>
		<input type="hidden" name="{{$name}}" id="quill_{{$quill_name}}_data" value="{{$value}}">
	</div>
	<script>
		var {{$quill_name}} = new Quill('#quill_{{$quill_name}}_editor', {
			modules: { toolbar: quill_toolbar },
			theme: 'snow'
		});
		document.getElementById('quill_{{$quill_name}}_block').addEventListener('click', function() {
			document.getElementById('quill_{{$quill_name}}_data').value = document.getElementById('quill_{{$quill_name}}_block').querySelector('.ql-editor').innerHTML;
			console.log('load');
		});
		document.getElementById('quill_{{$quill_name}}_block').addEventListener('keyup', function() {
			document.getElementById('quill_{{$quill_name}}_data').value = document.getElementById('quill_{{$quill_name}}_block').querySelector('.ql-editor').innerHTML;
			console.log('keyup');
		});

		{{-- /*
		//Quillの画像追加ボタンの変更
		$(function(){
			$('.withImage .ql-toolbar.ql-snow').append('<span class="ql-formats"><button type="button" class="quill-my-image"><svg viewBox="0 0 18 18"> <rect class="ql-stroke" height="10" width="12" x="3" y="4"></rect> <circle class="ql-fill" cx="6" cy="7" r="1"></circle> <polyline class="ql-even ql-fill" points="5 12 5 11 7 9 8 10 11 7 13 9 13 12 5 12"></polyline> </svg></button></span>');

			$(document).on("click", ".quill-my-image", function() {
				console.log("'.quill-my-image' was clicked");
				var range = {{$quill_name}}.getSelection();
				if (range) {
					{{$quill_name}}.insertEmbed(range.index,"image","https://placehold.jp/150x150.png")
				}
			});
		});
		*/ --}}
	</script>
	@break
@case('input')
	@if($as_block)<div class="form_block row g-3">@endif
		<div class="">
			@empty($title) @else <label class="{{$required}}" for="{{$id}}">{{$title}}</label> @endempty
			@empty($text) @else <p>{{$text}}</p> @endempty
			<input type="{{$input_type}}" class="form-control {{$class}}" id="{{$id}}" name="{{$name}}" value="{{$value}}" placeholder="{{$placeholder}}" {!! $extra !!} {{$required}}>
			<p class="formValidate_msg"> @error($name_forCode) {{ $message }} @enderror </p>
		</div>
	@if($as_block)</div>@endif
	@break
@case('checkbox')
	@if($as_block)<div class="form_block row pt-1" id="{{$id}}">@endif
		@empty($title) @else <label class="p-2 {{$required}}">{{$title}}</label> @endempty
		@empty($text) @else <p>{{$text}}</p> @endempty
		@foreach ($values as $v)
			@php
				$v[0] = isset($v[0])===false ? $title : $v[0];
				$v[1] = isset($v[1])===false ? $v[0] : $v[1];
				$checked = empty($v[2]) ? false : true;
			@endphp
			<div class="form-check">
				<label class="form-check-label fw-normal">
					<input type="checkbox" class="form-check-input {{$class}}" name="{{$name}}" value="{{$v[0]}}" {!! $extra !!} {{$required}}
					@php
						$n = str_replace('[]', '', $name);
						$ThisModel_n = empty($ThisModel->$n) ? '' : $ThisModel->$n;
					@endphp
					@if($checked)
						checked
					@elseif(is_array($ThisModel_n))
						@if(in_array($v[0],$ThisModel_n))
							checked
						@endif
					@endif
					>
					&thinsp;{{$v[1]}}
				</label>
				<p class="formValidate_msg"> @error($name_forCode) {{ $message }} @enderror </p>
			</div>
		@endforeach
	@if($as_block)</div>@endif
	<!---->
	@break
@case('radio')
	@if($as_block)<div class="form_block row pt-1" id="{{$id}}">@endif
		@empty($title) @else <label class="pt-2 {{$required}}">{{$title}}</label> @endempty
		@empty($text) @else <p>{{$text}}</p> @endempty
		@foreach ($values as $v)
			@php

				$v[0] = isset($v[0])===false ? $title : $v[0];
				$v[1] = isset($v[1])===false ? $v[0] : $v[1];
				$checked = empty($v[2]) ? false : true;
			@endphp
			<div class="form-check">
				<label class="form-check-label fw-normal">
					<input type="radio" class="form-check-input {{$class}}" name="{{$name}}" value="{{$v[0]}}" {!! $extra !!} {{$required}}
					@php
						$n = str_replace('[]', '', $name);
						$ThisModel_n = isset($ThisModel->$n) ? $ThisModel->$n : '';
					@endphp
					@if(is_array($ThisModel_n) )
						@if(in_array($v[0],$ThisModel_n))
							checked
							@php $checkedalready = true; @endphp
						@endif
					@elseif($v[0] == $ThisModel_n)
						checked
						@php $checkedalready = true; @endphp
					@elseif($checked && empty($checkedalready))
					{{-- ラジオボックスは複数のcheckedを設定できないため --}}
						checked
					@endif

					{{-- @if($checked)
						checked
					@elseif(is_array($ThisModel_n))
						@if(in_array($v[0],$ThisModel_n))
							checked
						@endif
					@endif --}}
					>
					&thinsp;{{$v[1]}}
				</label>
				<p class="formValidate_msg"> @error($name_forCode) {{ $message }} @enderror </p>
			</div>
		@endforeach
		@php $checkedalready = null; @endphp
	@if($as_block)</div>@endif
	<!---->
	@break
@case('select')
	@if($as_block)<div class="form_block row g-3 pt-1">@endif
		<div>
			@empty($title) @else <label class="{{$required}}" for="{{$id}}">{{$title}}</label> @endempty
			@empty($text) @else <p>{{$text}}</p> @endempty
			<select id="{{$id}}" class="form-select {{$class}}" name="{{$name}}" {!! $extra !!} {{$required}}>
				<option disabled >選択して下さい</option>
				@foreach ($values as $v)
					<option value="{{$v[0]}}"
					@php
						$n = str_replace('[]', '', $name);
						$ThisModel_n = empty($ThisModel->$n) ? '' : $ThisModel->$n;
					@endphp
					@if(is_array($ThisModel_n))
						@if(in_array($v[0],$ThisModel_n))
							selected
						@endif
					@endif
					>
						@empty($v[1])
							{{$v[0]}}
						@else
							{{$v[1]}}
						@endempty
					</option>
				@endforeach
			</select>
			<p class="formValidate_msg"> @error($name_forCode) {{ $message }} @enderror </p>
		</div>
	@if($as_block)</div>@endif
	<!---->
	@break
@case('plural')
	{{-- 'plural'は、old()で事前の内容取得不可 --}}
	@if($as_block)
		<div class="form_block pt-2 pb-3" data-maxcount="{{$maxcount}}">
		@empty($title) @else <label class="my-2" >{{$title}}</label> @endempty 
		@empty($text) @else <p class="mb-2">{{$text}}</p> @endempty
		<div class="form_pluralBox {{$sortable}} row g-2 {{$class}}" data-maxcount="{{$maxcount}}">
	@else
		@empty($title) @else <label class="mt-3 mb-2" >{{$title}}</label> @endempty 
		@empty($text) @else <p class="mb-2">{{$text}}</p> @endempty
		<div class="form_pluralBox {{$sortable}} row g-2 pt-2 pb-3 {{$class}}" data-maxcount="{{$maxcount}}">
	@endif
				@php
				if(empty($sortable)){
					$sortable_code = '<div class="input-group">';
				}else{
					$sortable_code = '<div class="input-group py-2 px-1 bg-light border">
					<div class="d-flex align-items-center px-2">
						<i class="fas fa-arrows-alt-v fs-3 pe-auto" style=""></i>
					</div>';
				}

				if(!is_array($value)){
					$value = [$value,];
					$value2 = [$value2,];
				}
				switch ($plural_type) {
					case 'text':
					case 'textarea':
						$form_pluralEndCode = '<button class="btn btn-secondary border pluralAdd pluralBtn" type="button">＋</button>
						<button class="btn btn-secondary border pluralDel pluralBtn" type="button">－</button></div><p class="err m-0 text-danger"></p>';
						break;
					case 'text_text':
					case 'text_url':
					case 'text_textarea':
						$form_pluralEndCode = '<div class="d-flex flex-column justify-content-center align-items-center px-2">
										<button class="btn btn-secondary border pluralAdd pluralBtn" type="button">＋</button>
										<button class="btn btn-secondary border pluralDel pluralBtn mt-1" type="button">－</button>
									</div></div><p class="err m-0 text-danger"></p>';
						break;
					default:
						break;
				}
				@endphp

				@switch($plural_type)
					@case('text')
						<div class="form_plural">
							{!! $sortable_code !!}
							<input type="text" class="form-control ps-1" name="{{$name}}" value="" placeholder="{{$placeholder}}" {!! $extra !!}>
							{!! $form_pluralEndCode !!}
						</div>
						@foreach ($value as $v)
							@if (!empty($v))
								<div class="form_plural">
									{!! $sortable_code !!}
									<input type="text" class="form-control ps-1" name="{{$name}}" value="{{$v}}" placeholder="{{$placeholder}}" {!! $extra !!}>
									{!! $form_pluralEndCode !!}
								</div>
							@endif
						@endforeach
						@break
					@case('textarea')
						<div class="form_plural">
							{!! $sortable_code !!}
							<textarea class="form-control sortableTA ps-1" name="{{$name}}" rows="1" placeholder="{{$placeholder}}" {!! $extra !!} ></textarea>
							{!! $form_pluralEndCode !!}
						</div>
						@foreach ($value as $v)
							@if (!empty($v))
								<div class="form_plural">
									{!! $sortable_code !!}
									<textarea class="form-control sortableTA ps-1" name="{{$name}}" rows="1" placeholder="{{$placeholder}}" {!! $extra !!} >{{$v}}</textarea>
									{!! $form_pluralEndCode !!}
								</div>
							@endif
						@endforeach
						@break
					@case('text_text')
						<div class="form_plural">
							{!! $sortable_code !!}
							<div class="d-flex flex-column align-items-center ps-1" style="flex-grow:6;width:100px">
								<input type="text" class="form-control checkInput_pluralRequired" name="{{$name}}" value="" placeholder="{{$placeholder}}" {!! $extra !!}>
								<input type="text" class="form-control targetInput_pluralRequired mt-1 {{$class}}" name="{{$name2}}" value="" placeholder="{{$placeholder2}}（上の項目を入力すると入力できます）" {{$extra2}} disabled="disabled" required>
							</div>
							{!! $form_pluralEndCode !!}
						</div>
						@foreach ($value as $key => $v)
							@if (!empty($v))
								<div class="form_plural">
									{!! $sortable_code !!}
									<div class="d-flex flex-column align-items-center ps-1" style="flex-grow:6;width:100px">
										<input type="text" class="form-control checkInput_pluralRequired" name="{{$name}}" value="{{$v}}" placeholder="{{$placeholder}}" {!! $extra !!}>
										<input type="text" class="form-control targetInput_pluralRequired mt-1 {{$class}}" name="{{$name2}}" value="{{$value2[$key]}}" placeholder="{{$placeholder2}}（上の項目を入力すると入力できます）" {{$extra2}} disabled="disabled" required>
									</div>
									{!! $form_pluralEndCode !!}
								</div>
							@endif
						@endforeach
						@break
					@case('text_url')
						<div class="form_plural">
							{!! $sortable_code !!}
							<div class="d-flex flex-column align-items-center ps-1" style="flex-grow:6;width:100px">
								<input type="text" class="form-control checkInput_pluralRequired" name="{{$name}}" value="" placeholder="{{$placeholder}}" {!! $extra !!}>
								<input type="url" class="form-control targetInput_pluralRequired mt-1 {{$class}}" name="{{$name2}}" value="" placeholder="{{$placeholder2}}（上の項目を入力すると入力できます）" {{$extra2}} disabled="disabled" required>
							</div>
							{!! $form_pluralEndCode !!}
						</div>
						@foreach ($value as $key => $v)
							@if (!empty($v))
								<div class="form_plural">
									{!! $sortable_code !!}
									<div class="d-flex flex-column align-items-center ps-1" style="flex-grow:6;width:100px">
										<input type="text" class="form-control checkInput_pluralRequired" name="{{$name}}" value="{{$v}}" placeholder="{{$placeholder}}" {!! $extra !!}>
										<input type="url" class="form-control targetInput_pluralRequired mt-1 {{$class}}" name="{{$name2}}" value="{{$value2[$key]}}" placeholder="{{$placeholder2}}（上の項目を入力すると入力できます）" {{$extra2}} disabled="disabled" required>
									</div>
									{!! $form_pluralEndCode !!}
								</div>
							@endif
						@endforeach
							@break
					@case('text_textarea')
						<div class="form_plural">
							{!! $sortable_code !!}
							<div class="d-flex flex-column align-items-center ps-1" style="flex-grow:6;width:100px">
								<input type="text" class="form-control sortableTA checkInput_pluralRequired" name="{{$name}}" value="" placeholder="{{$placeholder}}" {!! $extra !!}>
								<textarea class="form-control sortableTA targetInput_pluralRequired mt-1 {{$class}}" name="{{$name2}}" rows="1" placeholder="{{$placeholder2}}（前項目を入力すると入力できます）" {{$extra2}} disabled="disabled" required></textarea>
							</div>
							{!! $form_pluralEndCode !!}
						</div>
						@foreach ($value as $key => $v)
							@if (!empty($v))
								<div class="form_plural">
									{!! $sortable_code !!}
									<div class="d-flex flex-column align-items-center ps-1" style="flex-grow:6;width:100px">
										<input type="text" class="form-control sortableTA checkInput_pluralRequired" name="{{$name}}" value="{{$v}}" placeholder="{{$placeholder}}" {!! $extra !!}>
										<textarea class="form-control sortableTA targetInput_pluralRequired mt-1 {{$class}}" name="{{$name2}}" rows="1" placeholder="{{$placeholder2}}（前項目を入力すると入力できます）" {{$extra2}} disabled="disabled" required>{{$value2[$key]}}</textarea>
									</div>
									{!! $form_pluralEndCode !!}
								</div>
							@endif
						@endforeach
						@break

					@default
					@break
				@endswitch
			<p class="formValidate_msg"> @error($name_forCode) {{ $message }} @enderror </p>
	</div>
	@if($as_block)</div>@endif
	<!---->
	@break
@default
	<!-- 判定したい変数に0 1 2意外が格納されていた時の処理 -->
	@break
@endswitch