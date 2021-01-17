<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('img/bannerPs.png') }}" class="logo" alt="Patungan Sedekah Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
