<div class="u-align-center u-container-style u-group u-palette-5-light-2 u-shape-rectangle">
    <div class="u-container-layout u-container-layout-2 container">
        <h4 class="u-text first-item">
            <a class="u-product-title-link" style="margin: 10px">
                <?php echo $test_data['test_name']; ?>
            </a>
        </h4>
        <a class="u-align-center u-border-2 u-btn u-btn-round u-gradient u-none u-radius-4 u-btn-3 u-text-hover-white item" id="<?=$test_data['test_id'];?>">
            <span class="u-file-icon u-icon">
                <img alt="" src="/images/results_icon.png"/>
            </span>
            Результати тестувань
        </a>
        <a class="u-align-center u-border-2 u-btn u-btn-round u-gradient u-none u-radius-4 u-btn-3 u-text-hover-white item" href="/test-page.php?testId=<?=$test_data['test_id'];?>">
            <span class="u-file-icon u-icon">
                <img alt="" src="/images/edit.png"/>
            </span>
            Редагувати тест
        </a>
        <a class="delete-test u-align-center u-border-2 u-btn u-btn-round u-gradient u-none u-radius-4 u-btn-3 u-border-palette-2-base u-hover-palette-2-base u-text-hover-white item" id="<?=$test_data['test_id'];?>">
            <span class="u-file-icon u-icon">
                <img alt="" src="/images/cross.png"/>
            </span>
            Видалити тест
        </a>
    </div>
</div>
