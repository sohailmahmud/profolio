@extends("front.layout")

@section('content')
<div class="text-center"><h1>Please do not refresh this page...</h1></div>
<form method="post" action="{{ $paytm_txn_url }}" name="f1">
    {{ csrf_field()  }}
    <table border="1">
        <tbody>
		<?php
		foreach($paramList as $name => $value) {
			echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
		}
		?>
        <input type="hidden" name="CHECKSUMHASH" value="<?php echo htmlspecialchars($checkSum) ?>">
        </tbody>
    </table>

</form>

@endsection

@section('scripts')
<script src="{{asset('assets/front/js/paytm.js')}}"></script>
@endsection
