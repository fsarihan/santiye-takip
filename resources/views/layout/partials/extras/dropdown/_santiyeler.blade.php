<ul class="navi navi-hover py-4">
	@foreach($secilebilirSantiyelerGlobal as $secilebilirSantiye)
		<li class="navi-item">
			<a href="{{route('panel.santiyeSec',$secilebilirSantiye['id'] )}}" class="navi-link">
				<span class="navi-text">{{$secilebilirSantiye['adi']}}</span>
			</a>
		</li>
	@endforeach
</ul>
