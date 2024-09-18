import React, {useState} from "react";
import UsersListFilters from "../../filters/UsersListFilters.tsx";

type UsersSearchFormWidgetProps = {
    defaultFilters: UsersListFilters,
    callbackFunction: (filters: UsersListFilters) => void;
}

const UsersSearchFormWidget: React.FC<UsersSearchFormWidgetProps> = ({defaultFilters, callbackFunction}) => {
    const [filters, setFilters] = useState<UsersListFilters>(defaultFilters);

    console.log(filters);

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
        setFilters(defaultFilters);
        callbackFunction(filters);
    }

    return (
        <form onSubmit={handleSubmit}>
            <div>
                <label>Login</label>
                <input type={"text"} name={"login"} onChange={handleInputChange}/>
            </div>
            <div>
                <label>Email</label>
                <input type={"text"} name={"email"} onChange={handleInputChange}/>
            </div>

            <div>
                <button type={"button"} className={"btn-cancel"} onClick={handleCancel}>Cancel</button>
                <button type={"submit"} className={"btn-validate"}>Search</button>
            </div>
        </form>
    )
}

export default UsersSearchFormWidget;