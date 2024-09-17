import { useRouteError, useNavigate } from "react-router-dom";
import React from "react";

const ErrorPage: React.FC = () => {
    const error: unknown = useRouteError()
    const navigate = useNavigate();

    return (
        <div>
            <h1>Oops!</h1>
            <p>Sorry, an unexpected error has occurred.</p>
            <p>
                <i>
                    {(error as Error)?.message ||
                        (error as { statusText?: string })?.statusText}
                </i>
            </p>
            <button onClick={() => navigate(-1)}>&larr; Go back</button>
        </div>
    )

}

export default ErrorPage;