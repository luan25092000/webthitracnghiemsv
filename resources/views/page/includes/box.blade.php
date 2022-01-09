<div class="result_box {{ isset($res) ? 'activeResult' : '' }}">
    <div class="icon">
        <h2>Chúc mừng bạn đã hoàn thành bài thi!!</h2>
    </div>
    <div class="container-fluid" style="color: ">
        <h2>Thí sinh : {{ Auth::user()->name }}</h2>
        <div id="detail" class="detail_text">
            <span>Số lượng đúng: {{ isset($res) ? $res['result'] : '' }}</span>
        </div>
        <div class="complete_text text-center">Điểm của bạn:
            <div class="score_text">
                {{ isset($res) ? number_format(round((($res['score'] / $res['count']) * 10 * 100), 2) / 100, 2, '.', '') : '' }}
        </div>
        <div class="buttons flex-column">
            <a href="{{ route('page.index') }}" class="restart">Trang chủ</a>
            <a href="{{ route('history') }}" class="quit">Xem chi tiết</a>
        </div>
    </div>
    
</div>