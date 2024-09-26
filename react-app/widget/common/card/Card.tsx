import React, {ReactNode} from 'react';

type CardType = {
    children: ReactNode
}

const Card: React.FC<CardType> = ({ children }) => {
    return (
        <div className={"card"}>
            {children}
        </div>
    );
}

export default Card;