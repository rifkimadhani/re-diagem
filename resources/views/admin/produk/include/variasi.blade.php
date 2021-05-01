@for($i= 0; $i < count($variasi); $i++)
<tr>
    <td>
        {{ $variasi[$i]['pil1'] }}
        @if(!empty($variasi[$i]['id']))
            <input type="hidden" class="form-control variasi_id-{{ $variasi[$i]['pil1'] }}" name="variasi[{{$i}}][id]" value="{{ $variasi[$i]['id'] }}">
        @endif
        <input type="hidden" class="form-control pil1" name="variasi[{{$i}}][pil1]" value="{{ $variasi[$i]['pil1'] }}">
    </td>
    @if( $variasi[$i]['pil2'] !== null)
    <td>
        {{ $variasi[$i]['pil2'] }}
        <input type="hidden" class="form-control" name="variasi[{{$i}}][pil2]" value="{{ $variasi[$i]['pil2'] }}">
    </td>
    @endif
    <td>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    Rp
                </span>
            </div>
            <input type="number" class="form-control" name="variasi[{{$i}}][harga]" placeholder="Masukan Harga" value="{{ $variasi[$i]['harga'] }}">
        </div>
    </td>
    <td>
        <input type="number" class="form-control" name="variasi[{{$i}}][stok]" min="1" value="{{ $variasi[$i]['stok'] }}">
    </td>
    <td>
        <input type="text" class="form-control" name="variasi[{{$i}}][sku]" value="{{ $variasi[$i]['sku'] }}">
    </td>
</tr>
@endfor
