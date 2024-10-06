<p id="result-message"
   class="hidden w-2/3 md:w-1/2 mx-auto mt-6 text-center text-lg leading-8 text-light-text-secondary dark:text-dark-text-secondary">{{ __('Based on your movie preferences and the input you provided, we recommend these movies for you. We hope you like it!') }}</p>
<div id="recommendations-grid" class="grid grid-cols-1 md:grid-cols-2 mt-6 gap-7 text-black hidden">
    @for($i = 0; $i < 4; $i++)
        <div id="card-template-{{$i}}" class="flex flex-col gap-2 p-6 bg-additional-element shadow-lg rounded">
            <div class="flex flex-row gap-6">
                <div id="poster-{{$i}}" class="rounded h-fit bg-gray-300 animate-pulse">
                    <img id="poster-skeleton-{{$i}}" class="flex-none rounded" src="https://dummyimage.com/92x138/d2d5db/fff&text=+" alt="{{ __('poster') }}">
                    <img id="poster-content-{{$i}}" class="hidden flex-none rounded" src="" alt="{{ __('poster') }}">
                </div>

                <div class="basis-3/4">
                    <div
                        class="card-header uppercase pl-2 text-lg hover:text-black-text-hovered transition-colors duration-300">
                        <div id="title-skeleton-{{$i}}"
                             class="w-1/3 h-[21.5px] mt-2 bg-gray-300 animate-pulse rounded"></div>
                        <h2 id="title-content-{{$i}}" class="hidden">
                            <a id="title-text-{{$i}}" href=""></a>
                            <span id="title-year-{{$i}}" class="text-sm"></span>
                        </h2>
                    </div>

                    <div id="overview-{{$i}}" class="pt-1 text-sm">
                        <div id="overview-skeleton-{{$i}}" class="animate-pulse">
                            <div class="flex flex-row h-[12px] gap-2 mt-2 rounded">
                                <div class="w-1/4 bg-gray-300 rounded"></div>
                                <div class="w-3/4 bg-gray-300 rounded"></div>
                            </div>
                            <div class="flex flex-row h-[12px] gap-2 mt-2 rounded">
                                <div class="w-1/2 bg-gray-300 rounded"></div>
                                <div class="w-1/2 bg-gray-300 rounded"></div>
                            </div>
                            <div class="w-4/5 h-[12px] mt-2 bg-gray-300 rounded"></div>
                            <div class="w-3/4 h-[12px] mt-2 bg-gray-300 rounded"></div>
                        </div>
                        <div id="overview-content-{{$i}}" class="hidden">
                            <span id="overview-text-{{$i}}" class="line-clamp-4 overflow-hidden text-gray-800"></span>
                            <button id="showmore-button-{{$i}}"
                                    class="hidden cursor-pointer text-blue-500 hover:text-blue-700 text-sm focus:outline-none">{{ __('Show more') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="overview-creators-{{$i}}" class="pt-3 px-2 text-sm">
                <p id="overview-directors-{{$i}}"></p>
                <p id="overview-screenwriters-{{$i}}"></p>
                <p id="overview-casting-{{$i}}"></p>
            </div>
        </div>
    @endfor
</div>
<script>
    const translations = {
        directedBy: "{{ __('Directed by') }}",
        writtenBy: "{{ __('Written by') }}",
        starring: "{{ __('Starring') }}",
        showMore: "{{ __('Show more') }}",
        showLess: "{{ __('Show less') }}"
    };

    const elements = getMovieCardElements();
    addShowMoreButtonEvents()

    document.getElementById('recommendationsForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the form from submitting the traditional way

        showRecommendationsGrid();

        hideContent();
        showSkeletons();

        const form = event.target;
        const formData = new FormData(form);

        fetch("{{ route('getRecommendations') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    window.messagePanel.error(data.error);
                    document.getElementById('recommendations-grid').classList.add('hidden');
                    return;
                }

                adjustGrid(data.length);

                for (let i = 0; i < data.length; i++) {
                    const element = elements[i];

                    fillPosterData(element.posterContent, data[i]);
                    fillTitleData(element.titleText, element.titleYear, element.titleContent, data[i]);
                    fillOverviewData(element.overviewText, data[i]);
                    fillCreditsData(element.overviewDirectors, element.overviewScreenwriters, element.overviewCasting, data[i]);
                }

                hideSkeletons();
                showContent();
                handleShowMoreButtons();
                showResultMessage();

                document.getElementById('submit-button').textContent = "{{ __('Try again') }}";
            })
            .catch(() => {
                window.messagePanel.error('Something went wrong. Please try again later.');
            });
    });

    function showRecommendationsGrid() {
        document.getElementById('recommendations-grid').classList.remove('hidden');
    }

    function getMovieCardElements() {
        const elements = {};
        for (let i = 0; i < 4; i++) {
            elements[i] = {
                poster: document.getElementById('poster-' + i),
                posterSkeleton: document.getElementById('poster-skeleton-' + i),
                posterContent: document.getElementById('poster-content-' + i),
                titleSkeleton: document.getElementById('title-skeleton-' + i),
                titleContent: document.getElementById('title-content-' + i),
                titleText: document.getElementById('title-text-' + i),
                titleYear: document.getElementById('title-year-' + i),
                overviewSkeleton: document.getElementById('overview-skeleton-' + i),
                overviewContent: document.getElementById('overview-content-' + i),
                overviewText: document.getElementById('overview-text-' + i),
                showMoreButton: document.getElementById('showmore-button-' + i),
                overviewDirectors: document.getElementById('overview-directors-' + i),
                overviewScreenwriters: document.getElementById('overview-screenwriters-' + i),
                overviewCasting: document.getElementById('overview-casting-' + i),
                overviewCreators: document.getElementById('overview-creators-' + i)
            };
        }

        return elements;
    }

    function adjustGrid(n) {
        for (let i = 0; i < 4; i++) {
            if (i >= n) {
                document.getElementById('card-template-' + i).classList.add('hidden');
            } else {
                document.getElementById('card-template-' + i).classList.remove('hidden');
            }
        }
    }

    function showContent() {
        for (let i = 0; i < 4; i++) {
            elements[i].titleContent.classList.remove('hidden');
            elements[i].overviewContent.classList.remove('hidden');
            elements[i].overviewCreators.classList.remove('hidden');
            elements[i].posterContent.classList.remove('hidden');
        }
    }

    function hideContent() {
        for (let i = 0; i < 4; i++) {
            elements[i].titleContent.classList.add('hidden');
            elements[i].overviewContent.classList.add('hidden');
            elements[i].overviewCreators.classList.add('hidden');
            elements[i].posterContent.classList.add('hidden');
            elements[i].showMoreButton.classList.add('hidden');
        }
    }

    function showSkeletons() {
        for (let i = 0; i < 4; i++) {
            elements[i].posterSkeleton.classList.remove('hidden');
            elements[i].poster.classList.add('animate-pulse');
            elements[i].titleSkeleton.classList.remove('hidden');
            elements[i].overviewSkeleton.classList.remove('hidden');
        }
    }

    function hideSkeletons() {
        for (let i = 0; i < 4; i++) {
            elements[i].posterSkeleton.classList.add('hidden');
            elements[i].poster.classList.remove('animate-pulse');
            elements[i].titleSkeleton.classList.add('hidden');
            elements[i].overviewSkeleton.classList.add('hidden');
        }
    }

    function fillPosterData(posterContent, data) {
        posterContent.src = "https://image.tmdb.org/t/p/w92/" + data.poster_path;
    }

    function fillTitleData(titleText, titleYear, titleContent, data) {
        titleText.href = "{{ url('movies') }}/" + data.id;
        titleText.textContent = window.locale === 'en' || !data['title_' + window.locale] ? data.title : data['title_' + window.locale];

        const releaseYear = data.release_date.split('-')[0];
        titleYear.textContent = '(' + releaseYear + ')';
    }

    function fillOverviewData(overviewText, data) {
        overviewText.innerHTML = window.locale === 'en' || !data['overview_' + window.locale] ? data.overview : data['overview_' + window.locale];
        addLineClamp(overviewText);
    }

    function fillCreditsData(overviewDirectors, overviewScreenwriters, overviewCasting, data) {
        overviewDirectors.innerHTML = data.directors ? translations.directedBy + ': <span class="uppercase text-gray-800">' + data.directors + '</span>' : '';
        overviewScreenwriters.innerHTML = data.screenwriters ? translations.writtenBy + ': <span class="uppercase text-gray-800">' + data.screenwriters + '</span>' : '';
        overviewCasting.innerHTML = data.casting ? translations.starring + ': <span class="uppercase text-gray-800">' + data.casting + '</span>' : '';
    }

    function isTextTooBig(element) {
        return element.scrollHeight > element.offsetHeight;
    }

    function handleShowMoreButtons() {
        for (let i = 0; i < 4; i++) {
            if (isTextTooBig(elements[i].overviewText)) {
                displayShowMoreButton(elements[i].showMoreButton);
            }
        }
    }

    function displayShowMoreButton(showMoreButton) {
        showMoreButton.classList.remove('hidden');
        showMoreButton.textContent = translations.showMore;
    }

    function addLineClamp(overviewText) {
        overviewText.classList.add('line-clamp-4');
    }

    function addShowMoreButtonEvents() {
        for (let i = 0; i < 4; i++) {
            elements[i].showMoreButton.addEventListener('click', function () {
                elements[i].overviewText.classList.toggle('line-clamp-4');
                elements[i].showMoreButton.textContent = elements[i].overviewText.classList.contains('line-clamp-4') ? translations.showMore : translations.showLess;
            });
        }
    }

    function showResultMessage() {
        document.getElementById('result-message').classList.remove('hidden');
    }
</script>
