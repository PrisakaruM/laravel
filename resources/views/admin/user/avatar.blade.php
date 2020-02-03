<style>
.fancybox-content {
    width: 679px;
    height: 699px;
}

.submit {
    margin-left: 517px;
    background-color: black;
    color: aliceblue;
    border: coral;
    border-radius: 10px;
}

.form {
    height: 436px;
}
</style>

<link rel="stylesheet" href="{{$app->make('url')->to('/admin')}}/croppie/croppie.css">
<script src="{{$app->make('url')->to('/admin')}}/croppie/croppie.min.js"></script>

<form method="POST" class="form" action="{{route('user.avatar.upload', $id)}}" id="avatar-form" enctype="multipart/form-data">
    @csrf
    {{method_field('put')}}
    <input type="hidden" name="avatar" id="avatar_cropp">
    
    <div>
        <div>
            <input type="file" id="file-croppie"/>
		</div>
		
        @isset ($admin->image)
			<input type="hidden" name="old_big_image" value="{{$admin->image}}"/>
			<img class="old_big_image" src="{{asset('img/admin/') . '/' . $admin->image}}" alt="" width="200">	
		@endisset

        <div id="avatar-croppie"></div> 
        <div class="js-img-rotate-buttons">
            <button class="js-img-rotate-left" data-deg="+90"><span class="fa fa-rotate-left"></span> Rotate Left</button>
            <button class="js-img-rotate-right" data-deg="-90"><span class="fa fa-rotate-right"></span> Rotate Right</button>
        </div>
    </div>
    <input class="submit" type="submit">
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
$('.js-img-rotate-buttons').hide();
$('.js-hover-img-rotate-buttons').hide();

var croppie;

	$('#file-croppie').on('change', function(e) {
		$('.old_big_image').remove();

		if (typeof croppie != "undefined" && croppie != null) {
			$('#avatar-croppie').croppie('destroy');
		}

		var viewportWidth = 300;
		var viewportHeight = 300;

		var boundaryWidth = 200;
		var boundaryHeight = 200;

		if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			boundaryWidth = 200;
			boundaryHeight = 200;

			viewportWidth = 300;
			viewportHeight = 300;
		}

		croppie = $('#avatar-croppie').croppie({
			enableOrientation: true,
			enableExif: true,

			viewport: {
				width: viewportWidth,
				height: viewportHeight,
				type: 'square'
			},
			boundary: {
				width: boundaryWidth,
				height: boundaryHeight
			}
		});

		$('.js-img-rotate-buttons').show();

		$('.js-img-rotate-left,.js-img-rotate-right').on('click', function(e) {
			e.preventDefault();
			croppie.croppie('rotate', parseInt($(this).data('deg')));
		});

		if (this.files && this.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				croppie.croppie('bind', {
					url: e.target.result
				}).then(function(){});
			}

			reader.readAsDataURL(this.files[0]);
		}
	})
    $("#avatar-form").submit(function(e) {
		e.preventDefault();

        if ($('#file-croppie').val() == '') {
            alert('Please choose image!');
            return;
		}

        $('#avatar-croppie').croppie('result', {
            type: 'base64',
            size: {
                width: '600',
                height: '600'
            },
            format: 'jpeg',
            quality: 0.8
        }).then(function (resp) {

            $('#avatar_cropp').val(resp);
            ajax_request_form();        
        });
    });

    function ajax_request_form() {
		const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			timer: 3000,
			timerProgressBar: true,
			showConfirmButton: false,
			onOpen: (toast) => {
				toast.addEventListener('mouseenter', Swal.stopTimer)
				toast.addEventListener('mouseleave', Swal.resumeTimer)
			}
		});

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
			url : '{{route('user.avatar.upload', $id)}}',
			method : 'POST',
			dataType : 'JSON',
			data : new FormData($('#avatar-form')[0]),
            contentType: false,       
            cache: false,             
            processData:false, 
			success : function(response) {

				if (response.status == 'success') {
					$.fancybox.close();
					$('#users_table').DataTable().draw();

					Toast.fire({
						icon: 'success',
						title: response.message
					});
				}

				if (response.status == 'error') {
					Toast.fire({
						icon: 'warning',
						title: response.message
					});
				}
			}
		});
	}
</script>