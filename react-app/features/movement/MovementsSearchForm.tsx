import React, {useState} from "react";
import MovementsListFilters from "../../services/api/filters/MovementsListFilters.tsx";
import SearchForm from "../../components/form/SearchForm.tsx";
import {TextField} from "@mui/material";

type MovementSearchFormType = {
    defaultFilters: MovementsListFilters,
    callbackFunction: (filters: MovementsListFilters) => void;
}

const MovementsSearchForm: React.FC<MovementSearchFormType> = ({defaultFilters, callbackFunction}) => {
    const [filters, setFilters] = useState<MovementsListFilters>(defaultFilters);

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setFilters({
            ...filters,
            [event.target.name]: event.target.value
        });
    }

    const handleCancel = () => {
        setFilters(defaultFilters);
        callbackFunction(defaultFilters);
    }

    return (
        <SearchForm searchFunction={callbackFunction} cancelFunction={handleCancel} filters={filters}>
            <div>
                <TextField id="outlined-basic" label="IDs" variant="outlined" size="small"
                           name={"ids"} value={filters.ids ?? ''} onChange={handleInputChange} />
            </div>
            <div>
                <TextField id="outlined-basic" label="name" variant="outlined" size="small"
                           name={"name"} value={filters.name ?? ''} onChange={handleInputChange} />
            </div>
        </SearchForm>
    )
}

export default MovementsSearchForm;