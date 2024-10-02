import IndexedArray from "../../interfaces/IndexedArray.tsx";

const statuses: IndexedArray = {
    'created': 'Created',
    'active': 'Active',
    'deactivated': 'Deactivated',
}

const types: IndexedArray = {
    'member': 'member',
    'coach': 'coach',
    'admin': 'admin'
}

const userRegistries = {
    status: statuses,
    types: types
}

export default userRegistries;