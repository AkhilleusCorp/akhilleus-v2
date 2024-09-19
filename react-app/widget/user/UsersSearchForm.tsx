import React, {useState} from "react";
import UsersListFilters from "../../filters/UsersListFilters.tsx";

type UsersSearchFormType = {
    defaultFilters: UsersListFilters,
    callbackFunction: (filters: UsersListFilters) => void;
}

const UsersSearchForm: React.FC<UsersSearchFormType> = ({defaultFilters, callbackFunction}) => {
    const [filters, setFilters] = useState<UsersListFilters>(defaultFilters);

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
        defaultFilters.login = null;
        defaultFilters.email = null;

        setFilters(defaultFilters);
        callbackFunction(defaultFilters);
    }

    return (
        <form onSubmit={handleSubmit}>
            <div>
                <label>Login</label>
                <input type={"text"} name={"login"} value={filters.login ?? ''} onChange={handleInputChange}/>
            </div>
            <div>
                <label>Email</label>
                <input type={"text"} name={"email"} value={filters.email ?? ''} onChange={handleInputChange}/>
            </div>

            <div>
                <button type={"button"} className={"btn-cancel"} onClick={handleCancel}>Cancel</button>
                <button type={"submit"} className={"btn-validate"}>Search</button>
            </div>
        </form>
    )
}

export default UsersSearchForm;