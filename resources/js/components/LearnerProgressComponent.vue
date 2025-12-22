<template>
    <div class="container py-3">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="display-4 fw-bold text-dark mb-2">
                        <i class="bi bi-book-fill text-primary"></i>
                        Learner Progress Dashboard
                    </h1>
                    <p class="text-muted mb-0 fs-5">
                        Track learner progress across all courses
                    </p>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="courseFilter" class="form-label">
                    Filter by Course
                </label>
                <select
                    id="courseFilter"
                    class="form-select"
                    v-model="selectedCourse"
                    @change="fetchData">
                    <option value="">All Courses</option>
                    <option v-for="course in courses" :key="course.id" :value="course.name">
                        {{ course.name }}
                    </option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="sortSelect" class="form-label">
                    Sort by Progress
                </label>
                <select
                    id="sortSelect"
                    class="form-select"
                    v-model="sortBy"
                    @change="fetchData">
                    <option value="">No Sorting</option>
                    <option value="asc">Progress: Low to High</option>
                    <option value="desc">Progress: High to Low</option>
                </select>
            </div>

            <div class="col-md-4">
                <button class="btn btn-outline-primary w-100" @click="resetFilters">
                    Reset Filters
                </button>
            </div>
        </div>

        <!-- Loading State -->
        <div v-if="loading" class="text-center py-5">
            <div class="spinner-border spinner-border-custom text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3 text-white fs-5">Loading learner data...</p>
        </div>

        <!-- Error State -->
        <div v-else-if="error" class="alert alert-danger d-flex align-items-center" role="alert">
            <div>{{ error }}</div>
        </div>

        <!-- Empty State -->
        <div v-else-if="learners.length === 0" class="empty-state">
            <h3 class="text-muted">No learners found</h3>
            <p class="text-muted">Try adjusting your filters to see results.</p>
        </div>

        <!-- Learners List -->
        <div v-else>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                    <tr>
                        <th>Learner Name</th>
                        <th>Course</th>
                        <th>Progress %</th>
                        <th>Average %</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="learner in learners" :key="learner.id">
                        <tr v-for="(course, index) in learner.courses" :key="index" class="table-striped">
                            <td v-if="index === 0" :rowspan="learner.courses.length" class="align-top">
                                {{ learner.name }}
                            </td>
                            <td>{{ course.name }}</td>
                            <td>{{ course.progress }}%</td>
                            <td v-if="index === 0" :rowspan="learner.courses.length" class="align-top">
                                {{ learner.average_progress }}%
                            </td>
                        </tr>
                    </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "LearnerProgressComponent",
    data() {
        return {
            error: null,
            sortBy: '',
            courses: [],
            loading: false,
            learners: [],
            selectedCourse: ''
        };
    },
    mounted() {
        this.fetchData();
        this.fetchCourses();
    },
    methods: {
        async fetchData() {
            this.error = null;
            this.loading = true;

            try {
                const params = new URLSearchParams();
                if (this.selectedCourse) params.append('course', this.selectedCourse);
                if (this.sortBy) params.append('sort', this.sortBy);

                const response = await axios.get(`/api/learners?${params}`);
                this.learners = response.data.data;
            } catch (err) {
                this.error = 'Failed to load learner data. Please try again.';
            } finally {
                this.loading = false;
            }
        },
        async fetchCourses() {
            const response = await axios.get(`/api/courses`);
            this.courses = response.data.data;
        },
        resetFilters() {
            this.sortBy = '';
            this.selectedCourse = '';
            this.fetchData();
        }
    }
}
</script>

<style>
body {
    min-height: 100vh;
    padding: 2rem 0;
}

.dashboard-header {
    background: white;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    margin-bottom: 2rem;
}

.spinner-border-custom {
    width: 3rem;
    height: 3rem;
    border-width: 0.3rem;
}

.empty-state {
    background: white;
    border-radius: 12px;
    padding: 4rem 2rem;
    text-align: center;
}

.empty-state i {
    font-size: 4rem;
    color: #6c757d;
    margin-bottom: 1rem;
}
</style>
