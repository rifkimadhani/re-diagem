@for($i= 0; $i < count($variasi); $i++)
<tr>
    <td>
        {{ get_variant($variasi[$i]['variant']) }}
        <input type="hidden" class="form-control pil1" name="variasi[{{$i}}][pil1]" value="{{ get_variant($variasi[$i]['variant']) }}">
    </td>
    <td>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    Rp
                </span>
            </div>
            <input type="number" class="form-control" name="variasi[{{$i}}][harga]" placeholder="Masukan Harga" value="">
        </div>
    </td>
    <td>
        <input type="number" class="form-control" name="variasi[{{$i}}][stok]" min="1">
    </td>
    <td>
        <input type="text" class="form-control" name="variasi[{{$i}}][sku]">
    </td>
</tr>
@endfor
