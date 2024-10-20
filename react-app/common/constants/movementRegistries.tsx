import IndexedArray from "app/common/utils/interfaces/IndexedArray.tsx";

const statuses: IndexedArray = {
    'active': 'Active',
    'draft': 'Draft',
    'deactivated': 'Deactivated',
}

const movementRegistries = {
    status: statuses,
}

export default movementRegistries;