import IndexedArray from "../utils/interfaces/IndexedArray.tsx";

const statuses: IndexedArray = {
    'created': 'Created',
    'active': 'Active',
    'deactivated': 'Deactivated',
}

const types: IndexedArray = {
    'member': 'Member',
    'coach': 'Coach',
    'admin': 'Admin'
}

const userRegistries = {
    status: statuses,
    type: types
}

export default userRegistries;