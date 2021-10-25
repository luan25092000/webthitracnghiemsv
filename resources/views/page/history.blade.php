<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lịch sử thi</title>
</head>
<body>
    <div class="container">
        <div class="main col-8 mb-5">
            <h1>Chi tiết bài thi</h1>
            <p class="subject-title"><span style="width: 80px;display: inline-block">Đề thi: </span><b></b></p>
            <p class="sinvien-fullname"><span style="width: 80px;display: inline-block">Sinh viên: </span><b>Demo</b></p>
        </div>
        <div class="row">
            <div class="col-8" style="margin-bottom: 100px">
                <?php if(!empty($data['detail'])): ?>
                    <form action="">
                        <?php $count = 1; foreach ($data['detail'] as $detail): ?>
                        <div class="quiz-question">
                            <div class="quiz-question-title">
                                <h2>
                                    <span><?= $count; ?></span>
                                    <div><?= $detail['question_name']; ?></div>
                                </h2>
                            </div>
    
                            <?php
                            require_once "./mvc/models/AnswerModel.php";
                            $model = new AnswerModel();
                            $answers = $model->getAnswerByQuestionId($detail['question_id']);
                            ?>
    
                            <?php foreach ($answers as $answer): ?>
                                <div class="quiz-question-answer">
                                <?php if(isset($detail['selected'])): ?>
                                    <div class="answer-radio">
                                        <?php if ($detail['is_multiple']): ?>
                                        <?php $selected = explode(',', $detail['selected']); ?>
                                            <input class="form-check-input answer-checkbox"
                                                type="checkbox"
                                                <?= (in_array($answer['answer_id'], $selected)) ? 'checked' : ''; ?>
                                                name="option-<?= $answer['answer_id']; ?>"
                                                value="<?= $detail['question_id']; ?>-<?= $answer['answer_id']; ?>">
                                        <?php else: ?>
                                            <input type="radio"
                                                name="option-<?= $detail['question_id']; ?>"
                                                    <?= ($detail['selected'] == $answer['answer_id']) ? 'checked' : ''; ?>
                                                value="<?= $detail['question_id']; ?>-<?= $answer['answer_id']; ?>">
                                        <?php endif; ?>
                                        <label for="question-1">
                                            <?= $answer['answer_description']; ?>
                                            <?php if ($answer['is_correct']): ?>
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            <?php endif; ?>
                                        </label>
                                    </div>
                                <?php else: ?>
                                    <div class="answer-radio">
                                        <?php if ($detail['is_multiple']): ?>
                                            <input class="form-check-input answer-checkbox"
                                                type="checkbox"
                                                name="option-<?= $answer['answer_id']; ?>"
                                                value="<?= $detail['question_id']; ?>-<?= $answer['answer_id']; ?>">
                                        <?php else: ?>
                                            <input type="radio"
                                                name="option-<?= $detail['question_id']; ?>"
                                                value="<?= $detail['question_id']; ?>-<?= $answer['answer_id']; ?>">
                                        <?php endif; ?>
                                        <label for="question-1">
                                            <?= $answer['answer_description']; ?>
                                            <?php if ($answer['is_correct']): ?>
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            <?php endif; ?>
                                        </label>
                                    </div>
                                <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php $count++; endforeach; ?>
                    </form>
                <?php else: ?>
                    <div>Bài làm bỏ trắng</div>
                <?php endif; ?>
            </div>
            <div class="col-4">
                <h3 class="another-theme">Chủ đề</h3>
                <?php foreach ($data['themes'] as $theme): ?>
                    <div class="col-12 another-theme-item">
                        <div class="card">
                            <div class="cart-custom">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $theme['name']; ?></h5>
                                </div>
                                <div class="test-number">
                                    <h5><?= $theme['test_number']; ?></h5>
                                    <small>đề thi</small>
                                </div>
                            </div>
                            <a href="?url=subject/execute/<?= $theme['theme_id'] ?>" class="btn btn-detail">
                                <i class="fa fa-chevron-circle-right"></i>
                                Xem chi tiết
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>