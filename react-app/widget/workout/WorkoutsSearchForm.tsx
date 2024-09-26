import React, {useState} from "react";
import WorkoutsListFilters from "../../filters/WorkoutsListFilters.tsx";
import SearchForm from "../common/form/SearchForm.tsx";

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

    const handleCancel = () => {
        setFilters(defaultFilters);
        console.log(defaultFilters);
        callbackFunction(defaultFilters);
    }

    return (
        <SearchForm searchFunction={callbackFunction} cancelFunction={handleCancel} filters={filters}>
            <div className={"column"}>
                <div>
                    <label>IDs</label>
                    <input type={"text"} name={"ids"} value={filters.ids ?? ''} onChange={handleInputChange}/>
                </div>
                <div>
                    <label>Name</label>
                    <input type={"text"} name={"name"} value={filters.name ?? ''} onChange={handleInputChange}/>
                </div>
            </div>

            <div className={"column"}>
                <div>
                    <label>Status</label>
                    <input type={"text"} name={"statuses"} value={filters.statuses ?? ''} onChange={handleInputChange}/>
                </div>
            </div>
        </SearchForm>
)
}

export default WorkoutsSearchForm;