
import moment from 'moment';

export function isCurrent(value) {
    return isSameDate(new Date, value);
}

export function isSameDate(first, second) {
    first = moment(first);
    second = moment(second);

    return first.isSame(second, 'month')
        && first.isSame(second, 'day')
        && first.isSame(second, 'year');
}

export function urldate(value) {
    return moment(value).format('MM-DD-YYYY');
}

export function month(value) {
    return moment(value).format('MMMM');
}

export function weekday(value) {
    return moment(value).format('dddd');
}

export function day(value) {
    return moment(value).format('DD');
}

export function year(value) {
    return moment(value).format('YYYY');
}

export function longdate(value) {
    return `${month(value)} ${day(value)}, ${year(value)}`;
}

export function shortdate(value) {
    return `${month(value)} ${day(value)}`;
}

export function weekdays(value) {
    value = moment(value);

    const start = value.clone().startOf('isoWeek');

    return [...Array(7).keys()].map((v) => moment(start).add(v, 'days'));
}
