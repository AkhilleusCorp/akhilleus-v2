import React, {useState} from "react";
import WorkoutsListFilters from "../../filters/WorkoutsListFilters.tsx";

type WorkoutSearchFormType = {
    defaultFilters: WorkoutsListFilters,
    callbackFunction: (filters: WorkoutsListFilters) => void;
}

const WorkoutsSearchForm: React.FC<WorkoutSearchFormType> = ({defaultFilters, callbackFunction}) => {
    const [filters, setFilters] = useState<WorkoutsListFilters>(defaultFilters);

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setFilters({
            ...filters,
            [event.target.name]: event.target.value
        });
    }

    const handleSubmit = (event: React.FormEvent<HTMLFormElement>) => {
        event.preventDefault();
        callbackFunction(filters);
    }

    const handleCancel = () => {
        defaultFilters.name = null;

        setFilters(defaultFilters);
        callbackFunction(defaultFilters);
    }

    return (
        <form onSubmit={handleSubmit}>
            <div>
                <label>Name</label>
                <input type={"text"} name={"name"} value={filters.name ?? ''} onChange={handleInputChange}/>
            </div>

            <div>
                <button type={"button"} className={"btn-cancel"} onClick={handleCancel}>Cancel</button>
                <button type={"submit"} className={"btn-validate"}>Search</button>
            </div>
        </form>
    )
}

export default WorkoutsSearchForm;