<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
            <img src="{{ asset('2.png') }}" class="logo" alt="Logo">
            @else
            {{ $slot }}
            @endif
        </a>
    </td>
</tr>
