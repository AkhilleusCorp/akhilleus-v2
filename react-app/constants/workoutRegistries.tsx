import IndexedArray from "../utils/interfaces/IndexedArray.tsx";

const statuses: IndexedArray = {
    'planned': 'Planned',
    'in-progress': 'In progress',
    'completed': 'Completed',
}

const visibilities: IndexedArray = {
    'private': 'Private',
    'friends': 'Friends',
    'followers': 'Followers',
    'specific-client': 'Specific client',
    'all-clients': 'All clients',
    'public': 'Public'
}

const workoutRegistries = {
    status: statuses,
    visibility: visibilities
}

export default workoutRegistries;